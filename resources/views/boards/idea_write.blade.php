<x-app-layout>
    <x-slot name="header" >
        <div class="">
            <div class="container h-20">
                <h2 class="max-w-full text-center text-4xl font-extrabold text-neutral-900 dark:text-neutral-300">
                    Start with the basics
                </h2>
                <p class="mt-2 max-w-full text-center text-sm text-neutral-700 dark:text-neutral-400">
                    Make it easy for people to learn about your project.
                </p>
            </div>
        </div>
    </x-slot>
    <div class="container mx-auto max-w-6xl">
        <div class="">
            <form method="POST" wire:ignore action="{{ route('storeIdea') }}" enctype="multipart/form-data">
                <article class="py-10 border-b border-black/15 dark:border-white/15">
                    <h2 class="text-2xl font-semibold text-neutral-900 dark:text-neutral-300">Project title</h2>
                    <div class="">
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">
                            <span>Write a clear, brief title and subtitle to help people quickly understand your project. Both will appear on your project and pre-launch pages.</span>
                        </p>
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">
                            <span>Potential backers will also see them if your project appears on category pages, search results, or in emails we send to our community.</span>
                        </p>
                    </div>
                    <div class="grid gap-y-6 mt-5 p-6 border border-black/15 dark:border-white/15 rounded-lg text-neutral-900 dark:text-neutral-400">
                        <div class="flex flex-col gap-2">
                            <label class="" for="idea-name">Title</label>
                            <div class="grid justify-items-stretch">
                                <div class="inline-flex items-stretch min-h-12 border border-black/20 dark:border-white/20 rounded-md overflow-auto">
                                    <input id="idea-name" type="text" maxlength="60" name="idea-name" placeholder="EX) Papercuts: A Party Game for the Rude and Well-Read"  class="focus:ring-0 text-neutral-900">
                                </div>
                            </div>
                            <ul class="grid grid-flow-col gap-2">
                                <li class="grid-rows-1 inline-flex gap-1">
                                    <svg class="" style="width: 16px; aspect-ratio: 1 / 1;">
                                        <use xlink:href="#icon--info.sm.kds"></use>
                                    </svg> Short and sweet.
                                </li>
                                <li class="grid-rows-2 justify-self-end">
                                    <span data-testid="character count" class="align-baseline text-neutral-900 dark:text-neutral-400">13/60</span>
                                </li>
                            </ul>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="" id="react-aria6786714379-201" for="idea-description">Subtitle</label>
                            <div class="grid justify-items-stretch">
                                <div class="inline-flex items-stretch min-h-12 border border-black/20 dark:border-white/20 rounded-md overflow-auto">
                                    <textarea id="idea-description" maxlength="135" name="idea-description" placeholder="EX) A Papercuts is a rowdy card game about books and writing brought to you by Electric Literature." rows="2" class="focus:ring-0 text-neutral-900" ></textarea>
                                </div>
                            </div>
                            <ul class="grid grid-flow-col gap-2" id="">
                                <li class="grid-rows-1 inline-flex gap-1">
                                    <svg class="" style="width: 16px; aspect-ratio: 1 / 1;">
                                        <use xlink:href="#icon--info.sm.kds"></use>
                                    </svg>Short and sweet.
                                </li>
                                <li class="grid-rows-2 justify-self-end">
                                    <span data-testid="character count">10/135</span>
                                </li>
                            </ul>
                        </div>
                        <div class="flex flex-col gap-2">
                            <div style="min-width: 24px;">
                                <svg class="kds-icon kds-fill-icon-green" style="width: 24px; aspect-ratio: 1 / 1;">
                                    <use xlink:href="#icon--lightbulb.kds"></use>
                                </svg>
                            </div>
                            <div class="kds-mt-01">
                                <span class="">Give backers the best first impression of your project with great titles. 
                                    <button id="projectTitleTipCTA" type="button" aria-expanded="false" class="kds-p-0" data-rac="" style="font-weight: inherit; font-size: inherit; color: inherit;">
                                        <span class="text-underline">Learn more...</span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </article>

                <article class="py-10 border-b border-black/15 dark:border-white/15">
                    <h2 class="text-2xl font-semibold text-neutral-900 dark:text-neutral-300">Introduce your project</h2>
                    <div class="">
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">
                            <span>Tell people why they should be excited about your project. Get specific but be clear and be brief.</span>
                        </p>
                    </div>
                    <div class="mt-5 border border-black/15 dark:border-white/15 rounded-lg overflow-auto">
                            @csrf
                            @livewire('idea_editer')
                    </div>
                </article>
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