<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Visit;

class ApiTest extends TestCase
{
    use RefreshDatabase; // If you want to reset your database after each test

    /**
     * Test tracking a visit with a valid external ID.
     *
     * @return void
     */
    public function testTrackVisitValidExternalId()
    {
        // Create a dummy visit record and ensure 'updated_at' is definitely in the past
        $visit = Visit::factory()->create([
            'external_id' => '12345',
            'updated_at' => now()->subDay()
        ]);

        // Store the old timestamp
        $oldTimestamp = $visit->updated_at;

        // Make a GET request to the track-visit endpoint
        $response = $this->get('/api/track-visit/' . $visit->external_id);

        // Assert the request was successful
        $response->assertStatus(200);

        // Re-retrieve the visit from the database
        $visit->refresh();

        // Assert that 'updated_at' timestamp is greater than the old timestamp
        $this->assertTrue($visit->updated_at->gt($oldTimestamp));
    }

    /**
     * Test tracking a visit with an invalid external ID.
     *
     * @return void
     */
    public function testTrackVisitInvalidExternalId()
    {
        // Make a GET request to the track-visit endpoint with an invalid ID
        $response = $this->get('/api/track-visit/invalid-id');
    
        // Assert the request failed with a 400 status code
        $response->assertStatus(400);
    
        // Assert the correct error message is returned
        $response->assertJson([
            'status' => 400,
            'errors' => 'Something went wrong.External ID is not found.Please try again',
            'code' => 400
        ]);
    }
    
    /**
     * Test updating a user stage with valid data.
     *
     * @return void
     */
    public function testUpdateUserStageWithValidData()
    {
        // Create a dummy visit record
        $visit = Visit::factory()->create(['external_id' => '12345']);

        // Make a POST request to the update-stage endpoint
        $response = $this->post('/api/update-stage', [
            'externalId' => $visit->external_id,
            'stage' => 'viewed_page'
        ]);

        // Assert the request was successful
        $response->assertStatus(200);

        // Assert the visit stage was updated
        $this->assertEquals('viewed_page', $visit->fresh()->stage);
    }
}
