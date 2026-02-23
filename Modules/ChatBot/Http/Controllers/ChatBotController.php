<?php

namespace Modules\ChatBot\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatBotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('chatbot::index');
    }

    /**
     * Handle the chatbot message request.
     */
    public function handleMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $userMessage = $request->input('message');
        
        // In a real scenario, you would call an AI API here (OpenAI, Gemini, etc.)
        // For now, we'll provide a smart-looking mock response.
        
        $response = $this->getAiResponse($userMessage);

        return response()->json([
            'status' => 'success',
            'message' => $response,
        ]);
    }

    /**
     * Sophisticated response logic for the portfolio.
     */
    private function getAiResponse($message)
    {
        $message = strtolower($message);
        
        // Knowledge Base - Priority ordered (Specific -> Generic)
        $kb = [
            'good_morning' => [
                'keywords' => ['good morning', 'morning nirbhay', 'gm nirbhay'],
                'response' => "Very Good Morning ☀️ and have a nice day! How can we help you today? You can also book a meeting with Nirbhay to discuss your project."
            ],
            'current_company' => [
                'keywords' => ['current company', 'currently working', 'where working now', 'present company', 'which company currently working nirbhay'],
                'response' => "Nirbhay is currently working at **MOBIIWORLD Pvt. Limited | Nov 2025 - Present** as a Senior Laravel Developer & Tech Lead."
            ],
            'availability' => [
                'keywords' => ['available', 'availability', 'freelance', 'hire now', 'open for work', 'open to work', 'can we hire'],
                'response' => "Yes, Nirbhay is available for freelance and long-term projects. You can book a meeting to discuss your requirements or reach out directly via email or WhatsApp."
            ],
            'meeting' => [
                'keywords' => ['meeting', 'book call', 'schedule call', 'zoom meeting', 'consultation', 'appointment'],
                'response' => "You can schedule a meeting with Nirbhay to discuss your project requirements. Please use the contact form or message directly on WhatsApp to fix a time."
            ],
            'pricing' => [
                'keywords' => ['price', 'pricing', 'cost', 'budget', 'charges', 'rate', 'salary', 'hourly rate'],
                'response' => "Project pricing depends on scope and complexity. For an accurate estimate, please share your requirements and Nirbhay will provide a tailored quote."
            ],
            'remote' => [
                'keywords' => ['remote', 'work remotely', 'onsite', 'hybrid', 'international clients'],
                'response' => "Nirbhay works with clients globally and is comfortable with remote, hybrid, and international collaboration."
            ],
            'leadership' => [
                'keywords' => ['team lead', 'leadership', 'manage team', 'technical lead', 'architect'],
                'response' => "Nirbhay has extensive experience leading development teams, designing scalable architectures, and mentoring junior developers."
            ],
            'ai' => [
                'keywords' => ['ai', 'chatbot', 'automation', 'machine learning', 'gemini', 'openai'],
                'response' => "Nirbhay also works on AI-powered solutions including chatbot integrations, automation systems, and API-driven intelligent workflows."
            ],
            'payment' => [
                'keywords' => ['payment', 'razorpay', 'paypal', 'cashfree', 'stripe', 'gateway integration'],
                'response' => "Nirbhay has deep experience integrating secure payment gateways including Razorpay, PayPal, Cashfree, Stripe, and custom payment workflows."
            ],
            'database' => [
                'keywords' => ['database', 'db', 'mysql optimization', 'query optimization', 'performance', 'slow queries'],
                'response' => "Nirbhay specializes in database optimization, complex query tuning, indexing strategies, and performance improvements for large-scale Laravel applications."
            ],
            'saas' => [
                'keywords' => ['saas', 'multi vendor', 'super app', 'food delivery app', 'ride booking', 'marketplace'],
                'response' => "Nirbhay has architected and developed scalable SaaS platforms and Super Apps including food delivery, ride booking, logistics, and multi-vendor marketplace systems."
            ],
            'contact' => [
                'keywords' => ['contact', 'email', 'phone', 'call', 'skype', 'whatsapp', 'reach', 'mobile', 'address'],
                'response' => "You can reach Nirbhay directly:\n- **Email**: nirbhaydhaked@gmail.com\n- **Phone/Whatsapp**: +91 8209-99-0511\n- **Skype**: live:718c6b5c940cd730\n- Or use the contact form at the bottom of this page!"
            ],
            'resume' => [
                'keywords' => ['resume', 'cv', 'biodata', 'curriculum vitae', 'profile file', 'download resume'],
                'response' => "Sure! You can download Nirbhay's professional resume here: [📄 Download Resume (PDF)](/Nirbhay%20Singh%20SR.%20Laravel%20Developer.pdf)"
            ],
            'education' => [
                'keywords' => ['education', 'edu', 'degree', 'mca', 'bca', 'university', 'college', 'studied', 'qualification', 'educations'],
                'response' => "Nirbhay holds an **MCA (Honours)** from RTU, Kota and a **BCA** from UOR, Jaipur. He has a strong academic foundation in computer applications and systems architecture."
            ],
            'location' => [
                'keywords' => ['jaipur', 'india', 'where', 'location', 'city', 'rajasthan'],
                'response' => "Nirbhay is based in **Jaipur, Rajasthan (India)**. He is widely recognized as a top **Laravel Expert in Jaipur** and serves clients globally including India, UAE, and USA."
            ],
            'skills' => [
                'keywords' => ['skills', 'tech', 'technology', 'stack', 'backend', 'api', 'mysql', 'redis', 'jquery', 'expertise', 'postgre', 'pgsql'],
                'response' => "His core technical stack includes:\n- **Framework**: Laravel (all versions including 12)\n- **Backend**: Core PHP, RESTful APIs\n- **Database**: MySQL (Optimization expert), PgSQL,  Redis\n- **Frontend**: jQuery, Ajax, HTML5/CSS3\n- **DevOps**: Linux Server Management, Git, CI/CD"
            ],
            'services' => [
                'keywords' => ['services', 'hire', 'work', 'projects', 'build', 'cost', 'pricing', 'develop'],
                'response' => "Nirbhay offers premium services in:\n- **SaaS Architecture**\n- **Custom CRM Solutions**\n- **Payment Gateway Integration**\n- **Third-party API Integrations**\n- **Database Performance Tuning**"
            ],
            'experience' => [
                'keywords' => ['experience', 'exp', 'exp.', 'years', 'senior', 'career', 'journey', 'work history', 'professional experience', 'where worked', 'companies'],
                'response' => "Nirbhay's professional journey spans over **12+ years**. Here is his career timeline:\n\n" .
                              "<div class='chat-timeline'>" .
                              "<div class='timeline-item'><div class='timeline-dot'></div><div class='timeline-content'><strong>Senior Laravel Developer & Tech Lead</strong><br><small>MOBIIWORLD | Nov 2025 - Present</small></div></div>" .
                              "<div class='timeline-item'><div class='timeline-dot'></div><div class='timeline-content'><strong>Software Engineer (Laravel Module Lead)</strong><br><small>OPTIMA TAX RELIEF | Jan 2025 - Nov 2025</small></div></div>" .
                              "<div class='timeline-item'><div class='timeline-dot'></div><div class='timeline-content'><strong>Sr. Laravel Developer & Tech Lead</strong><br><small>KONSTANT INFOSOLUTIONS | Dec 2017 - Nov 2024</small></div></div>" .
                              "<div class='timeline-item'><div class='timeline-dot'></div><div class='timeline-content'><strong>Senior Software Engineer</strong><br><small>ARKA SOFTWARES | Jun 2016 - Dec 2017</small></div></div>" .
                              "<div class='timeline-item'><div class='timeline-dot'></div><div class='timeline-content'><strong>PHP Developer</strong><br><small>WDP TECHNOLOGIES | Sep 2015 - Jun 2016</small></div></div>" .
                              "<div class='timeline-item'><div class='timeline-dot'></div><div class='timeline-content'><strong>Web Programmer & Developer</strong><br><small>ECARE SOFTECH | Sep 2014 - Sep 2015</small></div></div>" .
                              "</div>\n\n" .
                              "![Professional Experience Timeline](/images/professional-experience.png)\n\n" .
                              "*(Click the image above to download the full timeline profile)*\n\n" .
                              "[📄 Download Full CV (PDF)](/Nirbhay%20Singh%20SR.%20Laravel%20Developer.pdf)"
            ],
            'laravel' => [
                'keywords' => ['laravel', 'framework', 'php'],
                'response' => "Nirbhay is a **Laravel Expert**. He has been working with Laravel since its early versions and is proficient in its latest features (including Laravel 12)."
            ],
            'who' => [
                'keywords' => ['who are you', 'how many', 'assistant', 'bot'],
                'response' => "I am an AI assistant for **Nirbhay Dhaked**, a Senior Laravel Expert based in Jaipur, India. I can tell you about his skills, experience, or how to reach him!"
            ],
            'nirbhay' => [
                'keywords' => ['nirbhay', 'dhaked', 'the developer', 'author', 'laravel expert', 'expert'],
                'response' => "**Nirbhay Dhaked** is a dedicated Senior **Technology Lead & Laravel Expert** with over 12 years of experience building robust, scalable web applications."
            ],
            'thank_you' => [
                'keywords' => [
                    'thank you',
                    'thanks',
                    'thnx',
                    'thank u',
                    'ty',
                    'thanks a lot',
                    'thankyou',
                    'ok thanks',
                    'great thanks'
                ],
                'responses' => [
                    "You're most welcome 😊 If you need anything else, feel free to ask!",
                    "Glad I could help! Let me know if you'd like to book a meeting with Nirbhay.",
                    "My pleasure! I'm here if you have more questions.",
                    "Happy to help 🙌 Feel free to explore more about Nirbhay's experience or services.",
                    "Anytime! Have a great day ahead 🚀"
                ]
            ],
            'projects' => [
                'keywords' => [
                    'projects',
                    'project list',
                    'what projects',
                    'what have you built',
                    'portfolio projects',
                    'laravel projects',
                    'work experience projects',
                    'real world projects',
                    'systems developed',
                    'applications built',
                    'experience in projects',
                    'what kind of apps'
                ],
                'response' => "Here are some major Laravel-based projects Nirbhay has worked on:\n\n" .

                "🚀 **Super App Architecture**\n" .
                "- Food Delivery System\n" .
                "- Ride Booking Platform\n" .
                "- Cab Booking System\n" .
                "- Logistics & Parcel Delivery Module\n" .
                "- Multi-Service Marketplace\n\n" .

                "🛒 **E-Commerce & Marketplace Platforms**\n" .
                "- Multi-vendor Marketplace\n" .
                "- Advanced Product Variant System\n" .
                "- Wallet & Referral System\n" .
                "- Dynamic Pricing & Coupons\n" .
                "- Payment Gateway Integrations (Razorpay, PayPal, Cashfree, Stripe)\n\n" .

                "💼 **Custom CRM & Enterprise Systems**\n" .
                "- Tax Management System (USA Client)\n" .
                "- Custom Lead Management CRM\n" .
                "- Role-based Access Control Systems\n" .
                "- Automated Workflow & Task Management Systems\n\n" .

                "📊 **SaaS Platforms**\n" .
                "- Subscription-based SaaS Applications\n" .
                "- Multi-tenant Architecture\n" .
                "- API-first Backend Systems\n" .
                "- Scalable Database Optimized Systems\n\n" .

                "⚡ **Performance & Optimization Work**\n" .
                "- Complex Query Optimization\n" .
                "- Database Indexing & Scaling\n" .
                "- Redis Caching Implementation\n" .
                "- API Response Optimization\n\n" .

                "🤖 **AI & Automation Integrations**\n" .
                "- AI Chatbot Integrations (Gemini/OpenAI)\n" .
                "- Automation APIs\n" .
                "- Smart Recommendation Systems\n\n" .

                "Nirbhay has over **12+ years of hands-on experience** building scalable, secure, and high-performance Laravel applications."
            ],
            'greeting' => [
                'keywords' => ['hello', 'hi', 'hey', 'greetings', 'namaste'],
                'response' => "Hello! I'm Nirbhay's AI assistant. How can I help you today? You can ask about his **education**, **skills**, or **location**."
            ]
        ];

        // Search for a match in priority order
        foreach ($kb as $intent => $data) {
            foreach ($data['keywords'] as $keyword) {
                // Check if the keyword exists as a whole word boundary match
                if (preg_match("/\b" . preg_quote($keyword, '/') . "\b/i", $message)) {
                    return $data['response'];
                }
            }
        }

        // Secondary search (partial matches)
        foreach ($kb as $intent => $data) {
            foreach ($data['keywords'] as $keyword) {
                if (str_contains($message, $keyword)) {
                    return $data['response'];
                }
            }
        }

        // Context-aware fallback
        if (str_contains($message, '?')) {
            return "That's an interesting question! For specific technical queries, you might want to contact Nirbhay directly at **nirbhaydhaked@gmail.com**.";
        }

        return "I'm here to help! You can ask me about Nirbhay's **experience**, his **skills** in Laravel, his **education**, or his **location** in Jaipur, India.";
    }
}
