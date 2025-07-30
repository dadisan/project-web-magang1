<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Destination;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProcessDestinationImage implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $destination;
  protected $originalPath;

  public function __construct(Destination $destination, string $originalPath)
  {
    $this->destination = $destination;
    $this->originalPath = $originalPath;
  }

  public function handle()
  {
    try {
      // Get the original image
      $imageContent = Storage::disk('public')->get($this->originalPath);

      // Create image instance
      $img = Image::make($imageContent);

      // Resize if image is too large
      if ($img->width() > 1200) {
        $img->resize(1200, null, function ($constraint) {
          $constraint->aspectRatio();
          $constraint->upsize();
        });
      }

      // Convert to jpg and optimize
      $img->encode('jpg', 70);

      // Generate optimized filename
      $optimizedFilename = 'destinations/optimized_' . Str::uuid() . '.jpg';

      // Save optimized version
      Storage::disk('public')->put($optimizedFilename, $img->stream());

      // Update destination with optimized image
      $this->destination->update([
        'featured_image' => $optimizedFilename
      ]);

      // Delete original image
      Storage::disk('public')->delete($this->originalPath);
    } catch (\Exception $e) {
      \Log::error('Error processing destination image', [
        'destination_id' => $this->destination->id,
        'error' => $e->getMessage()
      ]);
    }
  }
}
