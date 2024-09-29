<div>
    <!-- 프로필 사진 업로드 입력 -->
    <input type="file" wire:model="photo" class="hidden" id="photo" />

    <!-- 업로드된 새로운 프로필 사진 미리보기 -->
    @if ($photo)
        <img src="{{ $photo->temporaryUrl() }}" class="mt-2 rounded-full h-20 w-20 object-cover">
    @else
        <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}?v={{ time() }}" alt="{{ Auth::user()->name }}" class="rounded-full h-20 w-20 object-cover">
    @endif

    <!-- 새 프로필 사진 저장 버튼 -->
    <x-button wire:click="save" wire:loading.attr="disabled" class="mt-2">
        {{ __('Save Photo') }}
    </x-button>

    <!-- 프로필 사진 삭제 버튼 -->
    @if (Auth::user()->profile_photo_path)
        <x-secondary-button wire:click="deleteProfilePhoto" wire:loading.attr="disabled" class="mt-2">
            {{ __('Remove Photo') }}
        </x-secondary-button>
    @endif

    <!-- 업로드 오류가 있을 경우 표시 -->
    @error('photo') 
        <span class="error">{{ $message }}</span> 
    @enderror
</div>
