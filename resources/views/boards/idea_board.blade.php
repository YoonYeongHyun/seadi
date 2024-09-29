<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ㅎㅇ
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mx-auto px-4">
            @if(count($items) > 0)
            <div class="bg-white flex flex-row flex-wrap overflow-hidden shadow-xl sm:rounded">
                @foreach($items as $item)
                    <div class="inline-block basis-1/3 h-96">
                        <div class=" box-border basis-1/3 mx-5 mt-5 border-4 rounded-lg space-x">
                            <img src="\image\tempImg.png" alt="">
                            <p class="text-sm">{{ $item->title }} </p>
                        </div>
                    </div>
                    
                @endforeach
            </div>
            @else
            <p class="text-sm">게시글이 없습니다.</p>        
        @endif
        </div>
    </div>
</x-app-layout>

<?php
function Console_log($data){
    echo "<script>console.log( 'PHP_Console: " . $data . "' );</script>";
}
Console_log($items);
?>

