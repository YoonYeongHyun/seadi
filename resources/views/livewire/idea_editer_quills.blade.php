<div>
    <div id="editor" wire:model="content">
    </div>
    <input type="hidden" id="quill_html" name="content">
    
    <script>
        document.addEventListener('livewire:init', () => {
            var editor = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ 'header': 1 }, { 'header': 2 }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['image', 'link'],
                        ['align', { 'align': 'center' }],
                        ['clean']
                    ]   
                }
            });

            editor.getModule('toolbar').addHandler('image', function () {
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

            let previousImages = [];
            
            editor.on('text-change', function(delta, oldDelta, source) {
                try {
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
            
            Livewire.on('blogimageUploaded', function(imagePaths) {
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
            });
        });
    </script>
</div>