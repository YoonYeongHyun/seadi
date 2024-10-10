
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
            <form method="POST" wire:ignore action="{{ route('storeIdea') }}" enctype="multipart/form-data">
                @csrf
                @livewire('idea_editer')                
                <button type="submit" class="">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
<!--
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>
<script wire:ignore src="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.js"></script>
-->


<?php
function Console_log($data){
    echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
}
Console_log($users);
?>