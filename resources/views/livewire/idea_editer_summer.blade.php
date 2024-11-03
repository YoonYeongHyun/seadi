<!-- 라이브 와이어의 새로고침 방지를 위해 꼭 사용 - wire:ignore  -->
<div wire:model="content" wire:ignore> 
    <textarea id="description" name="idea-contents"></textarea>

    <!-- include summernote css/js -->
</div>
@script
    <script>
        $(document).ready(function() {
            
            let previousImages = [];

            $('#description').summernote({
                placeholder: 'Test 입니다.',
                tabsize: 2,
                height: 500,
                minHeight: null,
                maxHeight: 500,
                //focus: true,          // 에디터 로딩후 포커스를 맞출지 여부
                //lang: "ko-KR",        // 언어 설정
                toolbar: [
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['style', ['bold', 'italic', 'underline','strikethrough', 'clear']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['forecolor','color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['picture', 'link', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New','맑은 고딕','궁서','굴림체','굴림','돋움체','바탕체'],
                fontSizes: ['8','9','10','11','12','14','16','18','20','22','24','28','30','36','50','72'],
                callbacks: { //썸머노트 이벤트 정의 
                    
                    // 이미지 첨부
                    onImageUpload : function(files) {
                        console.log("--------------------image-upload---------------------------")
                        console.log(files);
                        uploadSummernoteImageFile(files,this);
                    },
                    
                    // 이미지 붙혀넣기
                    onPaste: function (e) {
                        console.log("--------------------image-paste---------------------------")
                        var clipboardData = e.originalEvent.clipboardData;
                        if (clipboardData && clipboardData.items && clipboardData.items.length) {
                            var item = clipboardData.items[0];
                            if (item.kind === 'file' && item.type.indexOf('image/') !== -1) {
                                e.preventDefault();
                            }
                        }
                    },
                    
                    // 에디터 내용 수정 - 이미지 삭제를 위해 사용
                    onChange: function(contents, $editable) {
                        console.log("--------------------text-change---------------------------");
                        console.log(contents, $editable);
                        var currentImages = [];
                        
                        $(contents).find("img").each(function(index, item){
                            currentImages.push(item.src);
                        });

                        var removedImages = previousImages.filter(function(image) {
                            return !currentImages.includes(image);
                        });
                        
                        removedImages.forEach(function(image) {
                            @this.deleteImage(image);
                            console.log('Image removed:', image);
                        });
                        
                        //이미지 리스트 갱신
                        previousImages = currentImages;

                        if(currentImages.length == 0){
                            previousImages = [];
                        }
                    }
                },
            });

            $("div.note-editable").on('drop',function(e){
                for(i=0; i< e.originalEvent.dataTransfer.files.length; i++){
                    uploadSummernoteImageFile(e.originalEvent.dataTransfer.files[i],$("#summernote")[0]);
                }
                e.preventDefault();
            })
            
            function uploadSummernoteImageFile(files, editor) {
                if (files.length > 0) {
                    let reader = new FileReader();
                    reader.readAsDataURL(files[0]);
                    reader.onload = function (event) {
                        var base64Data = event.target.result;
                        @this.uploadImage(base64Data);
                    }
                };
            }
            

            Livewire.on('blogimageUploaded', function(imagePaths) {
                console.log("--------------------blogimageUploaded---------------------------")
                console.log(imagePaths)
                $('#description').summernote('insertImage', imagePaths);
                /*
                $(editor).summernote('insertImage', result);

                if (Array.isArray(imagePaths) && imagePaths.length > 0) {
                    var imagePath = imagePaths[0]; // Extract the first image path from the array
                    console.log('Received imagePath:', imagePath);
                
                    if (imagePath && imagePath.trim() !== '') {
                        var range = editor.getSelection(true);
                        editor.insertText(range ? range.index : editor.getLength(), '\n', 'user');
                        editor.insertEmbed(range ? range.index + 1 : editor.getLength(), 'image', imagePath);
                    } else {
                        console.warn('Received empty or invalid imagePath');
                    }
                } else {
                    console.warn('Received empty or invalid imagePaths array');
                }
                */
            });
                /* 섬머노트 함수 적절히 빼서 쓰길

                - 서머노트 글쓰기
                $('#summernote').summernote('insertText', "써머노트에 쓸 텍스트");

                - 서머노트 쓰기 비활성화
                $('#summernote').summernote('disable');

                - 서머노트 쓰기 활성화
                $('#summernote').summernote('enable');

                - 서머노트 리셋
                $('#summernote').summernote('reset');

                - 마지막으로 한 행동 취소 ( 뒤로가기 )
                $('#summernote').summernote('undo');

                - 앞으로가기
                $('#summernote').summernote('redo');
                
                */
            /*
            $('div.note-editable').getModule('toolbar').addHandler('image', function () {
                //@this.set('content', editor.root.innerHTML);
                
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.click();
                
                
                input.onchange = function () {
                    var file = input.files[0];
                    if (file) {
                        var reader = new FileReader();
            
                        reader.onload = function(event) {
                            var base64Data = event.target.result;
                
                            @this.uploadImage(base64Data);
                        };
                    // Read the file as a data URL (base64)
                    reader.readAsDataURL(file);
                    }
                };
            });
            */
            
            
            /*
            $('div.note-editable').on('text-change', function(delta, oldDelta, source) {
                try {
                    console.log("--------------------text-change---------------------------")
                    var currentImages = [];
                
                    var container = editor.container.firstChild;
                
                    container.querySelectorAll('img').forEach(function(img) {
                        currentImages.push(img.src);
                    });
                    
                    var removedImages = previousImages.filter(function(image) {
                        return !currentImages.includes(image);
                    });
                
                    removedImages.forEach(function(image) {
                        @this.deleteImage(image);
                        console.log('Image removed:', image);
                    });
                
                    //이미지 리스트 갱신
                    previousImages = currentImages;

                    if(currentImages.length == 0){
                        previousImages = [];
                    }
                }catch (error) {
                    console.log(error);
                }
            });
            */
            
        });
    </script>
@endscript