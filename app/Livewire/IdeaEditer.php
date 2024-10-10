<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Intervention\Image\Image as Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Facades\Storage;

use function Livewire\store;

class IdeaEditer extends Component
{
    public $title;
    public $trixId;
    public $photos = [];
    public $cover_image;
    public $content = '';
    public $tags;
    public $imageNames = [];
    public $count = 1;

    public function increment($addValue)
    {
        $this->count = $this->count + $addValue;
    }

    public function render()
    {
        //return view('livewire.idea_editer_quills');
        return view('livewire.idea_editer_summer');
    }

    public function uploadImage($image)
    {
        $imageData = substr($image, strpos($image, ',') + 1);

        $time_now = date("ymdHis");
        
        $lastSixCharacters = substr($imageData, 0, 10);

        $imageData = base64_decode($imageData);

        $filename = $time_now . $lastSixCharacters . '.png';

        $manager = new ImageManager(new Driver());
        
        
        $resizedImage = $manager->read($imageData, );
        
        // 나중에 리사이징작업 필요 시 사용
        /*
        $resizedImage = $manager->read($imageData, )->resize(null, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        */

        // 디스크 경로는 filesystems.php 참고
        // 추후 클라우드로 변경 
        Storage::disk('public_storage')->put('/ideas_photos/' . $filename, $resizedImage->encode());
        
        $url = url("/storage/ideas_photos/" . $filename);

        $this->content .= '<img style="" src="' . $url . '" alt="Uploaded Image">';
        return $this->dispatch('blogimageUploaded', $url);
    }

    public function deleteImage($image)
    {
        $filename = substr($image, strpos($image, 'ideas_photos') + 13);

        if (file_exists(public_path("storage/ideas_photos/" . $filename))) {
            unlink(public_path("storage/ideas_photos/" . $filename));
        }
    }

    public function submitBlogPost()
    {
        $this->validate();

        $cover_photo = uniqid() . '.' . $this->cover_image->extension();
        $this->cover_image->storeAs('blog_cover_photo', $cover_photo, 'public_uploads');

        $blog = Blog::create([
            'title' => $this->title,
            'cover_image' => $cover_photo,
            'body' => $this->content,
            'tags' => $this->tags,
            'slug' => Str::slug($this->title)
        ]);

        return $this->dispatch('notify', 'Blog post created successfully', 'Success', 'success');
    }
}
