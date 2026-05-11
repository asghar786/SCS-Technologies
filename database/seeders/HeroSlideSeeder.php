<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        $slides = [
            [
                'badge'     => 'MBE Certified · Est. 1999',
                'title'     => 'Trusted Telecom & IT Infrastructure Solutions',
                'subtitle'  => 'Structured Cabling · Wi-Fi · Security · A/V · Web Development',
                'btn1_text' => 'About Us',
                'btn1_url'  => '/about',
                'btn2_text' => 'Request for Call',
                'btn2_url'  => '#callback',
                'order'     => 1,
                'active'    => true,
            ],
            [
                'badge'     => 'Nationwide Coverage',
                'title'     => 'MBE-Certified · Nationwide Coverage',
                'subtitle'  => 'Delivering projects on budget and on time since 1999.',
                'btn1_text' => 'Our Services',
                'btn1_url'  => '/services',
                'btn2_text' => 'Request for Call',
                'btn2_url'  => '#callback',
                'order'     => 2,
                'active'    => true,
            ],
            [
                'badge'     => 'Digital Transformation',
                'title'     => 'Complete Web & Software Solutions',
                'subtitle'  => 'Custom websites, ERP systems, mobile apps and more.',
                'btn1_text' => 'Learn More',
                'btn1_url'  => '/services/web-development-software',
                'btn2_text' => 'Request for Call',
                'btn2_url'  => '#callback',
                'order'     => 3,
                'active'    => true,
            ],
        ];

        foreach ($slides as $slide) {
            HeroSlide::firstOrCreate(['title' => $slide['title']], $slide);
        }
    }
}
