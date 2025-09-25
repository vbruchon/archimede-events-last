<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Spatie\Feed\Feedable;
//use Spatie\Feed\FeedItem;

class Event extends Model //implements Feedable
{
    use HasFactory;

    // Automatically cast these fields to a datetime format for the db
    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    public function structure()
    {
        return $this->belongsTo(Structure::class, 'structure_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function number_of_participants()
    {
        return $this->belongsTo(NumberOfParticipants::class, 'number_of_participants_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function accessType()
    {
        return $this->belongsTo(AccessType::class, 'accessType_id');
    }

    /* Implement the Feedable interface
    public function toFeedItem(): FeedItem
    {
        return FeedItem::create([
            'id' => $this->id,
            'title' => $this->name,
            'authorName' => $this->structure, //->name ?? 'Unknown',
            'summary' => $this->description,
            'updated' => $this->updated_at,
            'link' => !empty($this->link) ? $this->link : 'Aucun lien déclaré pour l\'instant.', // If no link
            'enclosureType' => $this->number_of_participants,

        ]);
    }

    // Fetch feed items from the last 7 days
    public static function getFeedItems()
    {
        return self::where('created_at', '>=', now()->subDays(7))->get();
        //return self::all(); //Fetch all events for testing purposes
    } */
}
