<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    protected $model = Job::class;

    // Dodaj statički brojač za praćenje trenutnog indeksa
    protected static $descriptionIndex = 0;
    protected static $codeIndex = 1000; // Početna vrednost za 'code'

    public function definition(): array
    {

        $jobDescriptions = [
            'Develop and maintain web applications using modern technologies.',
            'Manage projects, ensuring they are completed on time and within budget.',
            'Analyze complex data sets to provide insights and recommendations.',
            'Develop marketing strategies to promote products and services.',
            'Identify potential clients and sell products and services.',
            'Oversee the recruitment and onboarding of new employees.',
            'Conduct financial analysis and prepare reports.',
            'Provide support and assistance to customers.',
            'Create visual content for marketing materials.',
            'Provide technical support and troubleshooting for IT systems.',
            'Create and edit content for websites and marketing materials.',
            'Develop and manage product roadmaps and strategies.',
            'Analyze business processes and provide recommendations.',
            'Oversee daily operations to ensure efficiency.',
            'Design user interfaces and improve user experience.',
            'Prepare financial statements and manage accounting records.',
            'Maintain and configure network infrastructure.',
            'Manage social media accounts and create content.',
            'Test software applications for bugs and issues.',
            'Develop algorithms and models to analyze data.',
            'Source and interview potential candidates for job openings.',
            'Ensure compliance with legal and regulatory requirements.',
            'Plan and execute marketing campaigns.',
            'Develop software solutions for various business needs.',
            'Coordinate and oversee construction projects.',
            'Provide consulting services to clients on business strategies.',
            'Conduct market research and analysis.',
            'Manage the company’s financial planning and budgeting.',
            'Oversee the development and implementation of IT projects.',
            'Manage relationships with key clients and stakeholders.',
            'Conduct training sessions for employees.',
            'Design and implement cybersecurity measures.',
            'Coordinate logistics and supply chain operations.',
            'Develop and implement HR policies and procedures.',
            'Create and manage advertising campaigns.',
            'Provide legal advice and support to the company.',
            'Oversee the development of new products and services.',
            'Manage and optimize company’s online presence.',
            'Develop and maintain mobile applications.',
            'Plan and organize corporate events.',
            'Conduct internal audits and reviews.',
            'Provide customer support via phone and email.',
            'Develop training programs for employees.',
            'Oversee the management of company’s facilities.',
            'Create and manage digital marketing strategies.',
            'Conduct risk assessments and manage risk mitigation.',
            'Develop and maintain e-commerce platforms.',
            'Provide support for hardware and software issues.',
            'Manage company’s internal and external communications.',
            'Develop and implement quality control procedures.',
            'Analyze and report on sales performance.',
            'Coordinate and manage product launches.',
            'Develop financial models and forecasts.',
            'Provide support for end-users of software applications.',
            'Manage company’s branding and identity.',
            'Conduct competitive analysis and market research.',
            'Develop strategies for business growth and expansion.',
            'Provide administrative support to executives.',
            'Oversee the management of company’s inventory.',
            'Develop and implement training materials.',
            'Manage relationships with suppliers and vendors.',
            'Create and maintain documentation for business processes.',
            'Conduct environmental impact assessments.',
            'Manage company’s customer loyalty programs.',
            'Develop and implement CRM strategies.',
            'Provide support for network security issues.',
            'Oversee the management of company’s real estate assets.',
            'Develop and maintain relationships with media outlets.',
            'Conduct performance evaluations and appraisals.',
            'Manage the company’s employee benefits programs.',
            'Develop strategies for improving customer satisfaction.',
            'Provide support for cloud computing services.',
            'Manage company’s email marketing campaigns.',
            'Oversee the development of company’s website.',
            'Conduct financial audits and compliance checks.',
            'Provide support for video conferencing systems.',
            'Develop and implement project management methodologies.',
            'Manage company’s public relations efforts.',
            'Create and manage content for newsletters.',
            'Provide support for enterprise resource planning systems.',
            'Develop and implement change management strategies.',
            'Manage company’s IT infrastructure and services.',
            'Create and manage content for corporate blogs.',
            'Provide support for virtualization technologies.',
            'Develop and implement social responsibility programs.',
            'Manage company’s talent acquisition strategies.',
            'Create and manage content for training videos.',
            'Provide support for data backup and recovery.',
            'Develop and implement supply chain strategies.',
            'Manage company’s procurement processes.',
            'Oversee the management of company’s fleet vehicles.',
            'Develop and implement health and safety programs.',
            'Provide support for software development life cycle.',
            'Manage company’s financial reporting processes.',
            'Create and manage content for internal communications.',
            'Provide support for mobile device management.',
            'Develop and implement business continuity plans.',
            'Manage company’s contract negotiation processes.',
            'Oversee the management of company’s IT assets.',
            'Develop and implement employee engagement programs.',
            'Provide support for web hosting services.',
            'Manage company’s payroll processes.',
            'Create and manage content for social media advertising.',
            'Provide support for database management systems.'
        ];

        // Dobij trenutni opis i uvećaj brojač
        $description = $jobDescriptions[self::$descriptionIndex];
        self::$descriptionIndex = (self::$descriptionIndex + 1) % count($jobDescriptions);

        // Dobij trenutni kod i uvećaj brojač
        $code = 'P' . self::$codeIndex;
        self::$codeIndex++;


        return [
            'name' => $description,
            'code' => $code,
        ];
    }
}
