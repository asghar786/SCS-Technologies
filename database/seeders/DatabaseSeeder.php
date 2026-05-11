<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::firstOrCreate(['email' => 'admin@scs-technologies.com'], [
            'name' => 'SCS Admin',
            'password' => Hash::make('Admin@6857570'),
        ]);

        $this->seedSettings();
        $this->seedServices();
        $this->seedTestimonials();
        $this->seedFaqs();
    }

    private function seedSettings(): void
    {
        $settings = [
            'site_name'        => 'SCS Technologies',
            'tagline'          => 'A Team of Dedicated Professionals to Meet Your Needs',
            'phone'            => '+1 (305) 906-5182',
            'email'            => 'syeds@scs-technologies.com',
            'address_miami'    => '10125 NW 116th Way, Medley, Florida 33178',
            'address_orlando'  => 'Orlando, FL',
            'address_sc'       => 'Florence, SC',
            'address_tx'       => 'San Antonio, TX',
            'facebook'         => '#',
            'twitter'          => '#',
            'linkedin'         => '#',
            'youtube'          => '#',
            'hero_title_1'     => 'Trusted Telecom & IT Infrastructure Solutions',
            'hero_subtitle_1'  => 'Structured Cabling · Wi-Fi · Security · A/V · Web Development',
            'hero_title_2'     => 'MBE-Certified · Nationwide Coverage',
            'hero_subtitle_2'  => 'Delivering projects on budget and on time since 1999',
            'hero_title_3'     => 'Complete Web & Software Solutions',
            'hero_subtitle_3'  => 'Custom websites, ERP systems, mobile apps and more',
            'stat_years'       => '25+',
            'stat_employees'   => '100+',
            'stat_projects'    => '500+',
            'stat_states'      => '4',
            'about_description'=> 'SCS Technologies is a privately owned business dedicated to giving you the very best to meet and exceed your telecommunications and infrastructure needs. Consistently ranked among the top integrators in Florida, our in-house professional engineers and qualified technical staff deliver every project within budget and on time.',
            'footer_about'     => 'SCS Technologies provides comprehensive telecom, IT infrastructure, security, and software solutions across the United States. MBE-Certified · Est. 1999.',

            // Social handles
            'instagram'        => '#',

            // SEO
            'seo_title'        => 'SCS Technologies — Telecom, IT Infrastructure & Software Solutions',
            'seo_description'  => 'SCS Technologies is a MBE-certified telecom and IT infrastructure solutions provider. Structured cabling, Wi-Fi, surveillance, A/V, and web development. Est. 1999.',
            'seo_keywords'     => 'structured cabling, Wi-Fi network, access control, surveillance, audio visual, IT consulting, web development, MBE certified, Florida, telecom',

            // Hero slide images
            'hero_image_1'     => '',
            'hero_image_2'     => '',
            'hero_image_3'     => '',

            // Branding
            'logo'             => '',
            'favicon'          => '',

            // Analytics
            'google_analytics_id' => '',
            'clarity_id'          => '',
        ];

        $now = now();
        $rows = array_map(fn ($k, $v) => ['key' => $k, 'value' => $v, 'created_at' => $now, 'updated_at' => $now],
            array_keys($settings), array_values($settings));

        Setting::upsert($rows, ['key'], ['value', 'updated_at']);
    }

    private function seedServices(): void
    {
        $services = [
            [
                'title'      => 'Structured Cabling',
                'slug'       => 'structured-cabling',
                'icon'       => 'fa-solid fa-network-wired',
                'short_desc' => 'Comprehensive planning, design, installation, and maintenance of structured network cable infrastructure for commercial, educational, and industrial clients.',
                'full_desc'  => 'SCS Technologies offers comprehensive planning, design, installation, and maintenance of structured network cable infrastructure. Whether you need one or 1,000 drops installed, our in-house multi-state, OEM certified technicians handle wired network infrastructure across multiple states. Services include Cat5E & Cat6, fiber optic, coaxial cable, DAS, small cell antenna systems, data center build-outs, and outside plant cable infrastructure.',
                'order'      => 1,
            ],
            [
                'title'      => 'Wi-Fi Networks',
                'slug'       => 'wifi-networks',
                'icon'       => 'fa-solid fa-wifi',
                'short_desc' => 'Full-service wireless network design, implementation, and auditing across the country. Custom solutions for schools, hospitals, hotels, airports, and offices.',
                'full_desc'  => 'SCS offers full-service wireless fidelity (Wi-Fi) network implementation across the country. Each wireless solution is custom designed for its location, serving schools, universities, coffee shops, warehouses, hotels, airports, hospitals, and business offices. Services include Wi-Fi site surveys, wireless network design & installation, security audits, performance audits, point-to-point wireless, and wireless backhaul.',
                'order'      => 2,
            ],
            [
                'title'      => 'Access Controls',
                'slug'       => 'access-controls',
                'icon'       => 'fa-solid fa-lock',
                'short_desc' => 'Physical security solutions including RF controls, proximity card readers, smart cards, biometrics, and visitor management systems for any size facility.',
                'full_desc'  => 'SCS Technologies provides access control systems that allow organizations to control who can enter their facility or specific areas. Solutions include RF controls, proximity card readers, digital keypads, electric and magnetic locks, smart cards (PIV Cards), biometrics, and visitor management systems (VMS) — serving any size facility.',
                'order'      => 3,
            ],
            [
                'title'      => 'Surveillance Systems',
                'slug'       => 'surveillance-systems',
                'icon'       => 'fa-solid fa-camera',
                'short_desc' => 'IP-based video surveillance and access control systems with HD day/night cameras, video walls, remote access, and emergency call system integration.',
                'full_desc'  => 'SCS Technologies designs and implements comprehensive video surveillance and access control systems. Services include video management software, IP cameras, HD surveillance video, video walls for command and control, access control integration, secure remote access, and emergency call systems. Successfully installed hundreds of systems for education, private sector, and government clients.',
                'order'      => 4,
            ],
            [
                'title'      => 'Audio Visual Installation',
                'slug'       => 'audio-visual-installation',
                'icon'       => 'fa-solid fa-tv',
                'short_desc' => 'Professional A/V installation for commercial and educational facilities — projectors, digital signage, smart boards, videoconferencing, and public address systems.',
                'full_desc'  => 'SCS Technologies offers audio-visual installation services for commercial and educational facilities. Services include projector installation, TV mounting, digital signage, speaker installation (surround-sound, multi-room, PA systems), smart board & interactive classroom installation, videoconferencing setup, and A/V maintenance and upgrades. Coordination across multiple states with SCS as your single point of contact.',
                'order'      => 5,
            ],
            [
                'title'      => 'Network Testing & Certification',
                'slug'       => 'network-testing-certification',
                'icon'       => 'fa-solid fa-certificate',
                'short_desc' => 'State-of-the-art testing and certification for copper, fiber, video, audio, and wireless network systems with comprehensive documentation and CAD diagramming.',
                'full_desc'  => 'SCS Technologies provides network wiring testing and certification services for new installations and existing networks using state-of-the-art test equipment. Documentation is provided in printed and/or electronic format. Services cover copper cabling, fiber cabling, video, audio, and wireless networks — including CAD and Visio diagramming, labeling, and mapping services.',
                'order'      => 6,
            ],
            [
                'title'      => 'Consulting Services',
                'slug'       => 'consulting-services',
                'icon'       => 'fa-solid fa-lightbulb',
                'short_desc' => 'Strategic IT consulting covering data migration, cloud infrastructure, disaster recovery planning, and security compliance for government and commercial markets.',
                'full_desc'  => 'SCS Technologies provides strategic consulting for data management, cloud infrastructure, disaster recovery, and IT security. Services include data & migration management, cloud and virtualization assessment, disaster recovery capability development, and broad IT security consulting for Federal government and commercial markets — ensuring solutions meet internal business needs and external compliance parameters.',
                'order'      => 7,
            ],
            [
                'title'      => 'Web Development & Software Solutions',
                'slug'       => 'web-development-software',
                'icon'       => 'fa-solid fa-code',
                'short_desc' => 'Custom web development, business software, mobile apps, e-commerce platforms, and API integrations tailored to your business needs.',
                'full_desc'  => 'SCS Technologies delivers complete digital transformation through custom web development and software solutions. Our team specializes in custom websites (WordPress, Laravel, React), ERP and business software, mobile app development (iOS & Android), e-commerce solutions, API integration & automation, and professional UI/UX design. Whether you are launching a new digital presence or modernizing your existing systems, we deliver scalable, secure, and high-performance solutions.',
                'order'      => 8,
            ],
        ];

        $now = now();
        $rows = array_map(fn ($s) => array_merge($s, ['created_at' => $now, 'updated_at' => $now]), $services);
        Service::upsert($rows, ['slug'], ['title', 'icon', 'short_desc', 'full_desc', 'order', 'updated_at']);
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            [
                'client_name' => 'John Martinez',
                'company'     => 'Miami-Dade County Public Schools',
                'position'    => 'IT Director',
                'quote'       => 'SCS Technologies delivered our structured cabling project on time and within budget. Their team was professional, certified, and highly responsive throughout the entire process.',
                'rating'      => 5,
                'active'      => true,
            ],
            [
                'client_name' => 'Sarah Thompson',
                'company'     => 'Cleveland Clinic',
                'position'    => 'Facilities Manager',
                'quote'       => 'Exceptional work on our surveillance and access control systems. SCS provided a truly integrated solution that has dramatically improved our facility security.',
                'rating'      => 5,
                'active'      => true,
            ],
            [
                'client_name' => 'Robert Chen',
                'company'     => 'Delta Airlines',
                'position'    => 'Network Infrastructure Lead',
                'quote'       => 'We have relied on SCS Technologies for our Wi-Fi network deployments across multiple locations. Their expertise and nationwide reach make them the ideal partner.',
                'rating'      => 5,
                'active'      => true,
            ],
        ];

        $now = now();
        $rows = array_map(fn ($t) => array_merge($t, ['created_at' => $now, 'updated_at' => $now]), $testimonials);
        Testimonial::upsert($rows, ['client_name'], ['company', 'position', 'quote', 'rating', 'updated_at']);
    }

    private function seedFaqs(): void
    {
        $faqs = [
            ['question' => 'What areas does SCS Technologies serve?', 'answer' => 'SCS Technologies operates across the United States with offices in Miami FL, Orlando FL, Florence SC, and San Antonio TX. We serve clients nationwide for all our telecom and IT infrastructure services.', 'order' => 1],
            ['question' => 'Is SCS Technologies MBE-certified?', 'answer' => 'Yes. SCS Technologies is a Nationally Certified Minority Business Enterprise (MBE), which qualifies us to work on government and private sector projects that require or prefer MBE participation.', 'order' => 2],
            ['question' => 'How long has SCS Technologies been in business?', 'answer' => 'SCS Technologies was established in 1999. With over 25 years of experience, we have successfully completed several hundred self-performed installations for public and private sector clients.', 'order' => 3],
            ['question' => 'Can SCS handle multi-state projects?', 'answer' => 'Absolutely. With offices in Florida, South Carolina, and Texas, and a network of OEM-certified technicians, SCS Technologies regularly manages large-scale projects across multiple states with a single point of contact.', 'order' => 4],
            ['question' => 'What certifications do your technicians hold?', 'answer' => 'Our technicians are OEM-certified by major manufacturers including Tyco, JCI, Siemens, Securitas, and Ericsson. We are also FASA/BASA certified for security systems work.', 'order' => 5],
            ['question' => 'Do you offer web development and software services?', 'answer' => 'Yes! SCS Technologies recently expanded into web development and software solutions, offering custom websites, business software/ERP, mobile apps, e-commerce platforms, and API integrations.', 'order' => 6],
        ];

        $now = now();
        $rows = array_map(fn ($f) => array_merge($f, ['active' => true, 'created_at' => $now, 'updated_at' => $now]), $faqs);
        Faq::upsert($rows, ['question'], ['answer', 'order', 'updated_at']);
    }
}
