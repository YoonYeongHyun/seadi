
<x-app-layout>
    <x-slot name="header" >
        <div class="">
            <div class="container h-9">
                <h2 class="max-w-full text-center text-3xl font-extrabold">
                    떠오르는 아이디어를 표현해주세요!!
                </h2>    
            </div>
        </div>
        </x-slot>

    <div class="container mx-auto max-w-7xl pt-12 pb-24">
        <div class="">
            <form method="post">
                <textarea id="summernote" name="editordata"></textarea>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    $(document).ready(function() {
        //여기 아래 부분
        $('#summernote').summernote({
            height: 500,                 // 에디터 높이
            minHeight: null,             // 최소 높이
            maxHeight: null,             // 최대 높이
            focus: true,                  // 에디터 로딩후 포커스를 맞출지 여부
            lang: "ko-KR",					// 한글 설정
            placeholder: ''	//placeholder 설정
            
        });
    });
</script>
<script src="{{ asset('js/summernote') }}/summernote-lite.js"></script>
<script src="{{ asset('js/summernote') }}/lang/summernote-ko-KR.js"></script>
<link rel="stylesheet" href="{{ asset('css/summernote') }}/summernote-lite.css">
<?php
function Console_log($data){
    echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
}
Console_log($users);
?>

