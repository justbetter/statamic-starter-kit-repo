<?php

namespace Tests\Unit\Tags;

use App\Tags\Faq;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Attributes\Test;
use Statamic\Entries\Entry;
use Statamic\Tags\Parameters;
use Statamic\Taxonomies\Term;
use Tests\TestCase;

class FaqTest extends TestCase
{
    #[Test]
    public function it_returns_items_when_type_is_manual(): void
    {
        $entry1 = $this->mock(Entry::class);
        $entry2 = $this->mock(Entry::class);
        $manualItems = collect([$entry1, $entry2]);

        $parameters = $this->mock(Parameters::class, function ($mock) use ($manualItems) {
            $mock->shouldReceive('get')->with('type')->andReturn('manual');
            $mock->shouldReceive('get')->with('categories')->andReturn(collect());
            $mock->shouldReceive('get')->with('items')->andReturn($manualItems);
        });

        $tag = new Faq;
        $tag->params = $parameters;
        $result = $tag->getItems();

        $this->assertSame($manualItems, $result);
        $this->assertCount(2, $result);
    }

    #[Test]
    public function it_returns_empty_collection_when_no_categories(): void
    {
        $parameters = $this->mock(Parameters::class, function ($mock) {
            $mock->shouldReceive('get')->with('type')->andReturn(null);
            $mock->shouldReceive('get')->with('categories')->andReturn(collect());
            $mock->shouldReceive('get')->with('items')->andReturn(collect());
        });

        $tag = new Faq;
        $tag->params = $parameters;

        $result = $tag->getItems();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertTrue($result->isEmpty());
    }

    #[Test]
    public function it_returns_entries_from_categories(): void
    {
        $entry1 = $this->mock(Entry::class);
        $entry2 = $this->mock(Entry::class);
        $entry3 = $this->mock(Entry::class);

        $category1 = $this->mock(Term::class, function ($mock) use ($entry1, $entry2) {
            $mock->shouldReceive('entries')->andReturn(collect([$entry1, $entry2]));
        });

        $category2 = $this->mock(Term::class, function ($mock) use ($entry3) {
            $mock->shouldReceive('entries')->andReturn(collect([$entry3]));
        });

        $categories = collect([$category1, $category2]);

        $parameters = $this->mock(Parameters::class, function ($mock) use ($categories) {
            $mock->shouldReceive('get')->with('type')->andReturn(null);
            $mock->shouldReceive('get')->with('categories')->andReturn($categories);
            $mock->shouldReceive('get')->with('items')->andReturn(collect());
        });

        $tag = new Faq;
        $tag->params = $parameters;

        $result = $tag->getItems();

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertCount(3, $result);
        $this->assertContains($entry1, $result);
        $this->assertContains($entry2, $result);
        $this->assertContains($entry3, $result);
    }
}
