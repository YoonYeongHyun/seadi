
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
            @livewire('idea-editer')
        </div>
    </div>
</x-app-layout>

<?php
function Console_log($data){
    echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
}
Console_log($users);
?>

<?php phpinfo(); ?>