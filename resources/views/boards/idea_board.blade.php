<x-app-layout>
    <x-slot name="header" >
        <div class="">
            <div class="container h-32">
                <h2 class="max-w-full text-center text-3xl font-extrabold">
                    원하시는 아이디어를 검색하세요!
                </h2>    
                <div class="flex w-8/12 min-w-96 h-12 mx-auto mt-6 px-2 py-0.5 rounded-lg border border-gray-300">
                    <img class="w-7 h-7 mt-1 float-left" src="\image\Search_Black.svg" alt="">
                    <div class="flex-grow">
                        <input class="w-full border-none focus:outline-none focus:ring-0" type="text">
                    </div>
                </div>
            </div>
        </div>
        </x-slot>

    <div class="container mx-auto max-w-6xl">
        <div class="">
            <h2 class="max-w-full pl-4 py-6 text-left text-2xl font-extrabold">
                최신 아이디어
            </h2>    
            @if(count($ideas) > 0)
            <div class=" flex flex-row flex-wrap overflow-hidden sm:rounded">
                @foreach($ideas as $idea)
                    <div class="inline-block basis-1/3">
                        <div class=" box-border mx-4 mt-2 mb-14 p-4 rounded-3xl ring-1 ring-gray-200 hover:shadow-lg  focus:cursor-auto cursor-pointer">
                            <div class="relative max-w-xs rounded-2xl overflow-hidden bg-cover bg-no-repeat">
                                @if (!empty($idea->thumbnail_path))
                                    <img class="w-full h-44 rounded-2xl max-w-xs transition duration-300 ease-in-out hover:scale-110" 
                                         src="{{ asset('Seadi_Img/Idea_Thumbnail') }}/{{$idea->thumbnail_path}}" alt="">
                                @else
                                    <img class="w-full h-44 rounded-2xl" src="\image\tempImg.png" alt="">
                                @endif
                            </div>
                            <div class=" flex flex-row py-4 h-24">
                                <div class="inline-block basis-2/12 ">
                                    <img class="mx-auto mt-1.5 w-8 h-8 rounded-full ring-offset-2 ring-2 ring-blue-400 hover:ring-blue-700" 
                                         src="{{ asset('storage') }}/{{$idea->profile_photo_path}}" alt="">
                                </div>
                                <div class="inline-block basis-9/12 px-2">
                                    <p class="text-sm text-gray-500">{{ $idea->nickname }} </p>
                                    <p class="text-sm dark:text-gray-200" >{{ $idea->title }} </p>
                                </div>
                                <div class="inline-block basis-1/12">
                                    <div class="w-6 h-6 bg-cover common_bookmark">
                                    </div>
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
Console_log($ideas);
?>

