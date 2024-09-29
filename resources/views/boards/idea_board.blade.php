<x-app-layout>
    <x-slot name="header" >
        <div class="">
            <div class="container">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight h-48">
                    ㅎㅇ
                </h2>
            </div>
                
        </div>
        </x-slot>

    <div class="py-12">
        <div class=" container mx-auto max-w-7xl px-12 pt-12 pb-24">
            @if(count($items) > 0)
            <div class=" flex flex-row flex-wrap overflow-hidden sm:rounded">
                @foreach($items as $item)
                    <div class="inline-block basis-1/3">
                        <div class=" box-border mx-12 mt-2 mb-14 p-4 shadow-sm rounded-3xl hover:ring-1 ring-gray-300 focus:cursor-auto cursor-pointer">
                            @if (!empty($item->thumbnail_path))
                                <img class="w-full h-44 rounded-2xl" src="{{ asset('Seadi_Img/Idea_Thumbnail') }}/{{$item->thumbnail_path}}" alt="">
                            @else
                                <img class="w-full h-44 rounded-2xl" src="\image\tempImg.png" alt="">
                            @endif
                            <div class=" flex flex-row py-4 min-h-20 max-h-44">
                                <div class="inline-block basis-1/6">
                                    <img class="mx-auto mt-1.5 w-8 h-8 rounded-full ring-offset-2 ring-2 ring-blue-400 hover:ring-blue-700" 
                                         src="{{ asset('Seadi_Img/Idea_Thumbnail') }}/{{$item->thumbnail_path}}" alt="">
                                </div>
                                <div class="inline-block basis-5/6 pl-2">
                                    <p class="text-sm text-gray-500">{{ $item->writer_name }} </p>
                                    <p class="text-sm dark:text-gray-200" >{{ $item->title }} </p>
                                </div>
                                
                            </div>
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

