<?php
/**
 * Template part for displaying the FAQ section
 *
 * @package SarmadGardezi
 */

defined('ABSPATH') || exit;

// FAQ items with ACF support and reference fallbacks
$faq_items = array(
    array(
        'q' => 'What do you do?',
        'a' => "I build products from 0 to 1 as a product-minded CTO and engineer. In the early days I'm your technical partner: picking an architecture you won't regret, building the first product version, and being in the code while we figure out what the product wants to be.",
    ),
    array(
        'q' => 'What does a Fractional CTO do?',
        'a' => "Everything a CTO does, minus the full-time salary — strategy one day, hands-on building the next. The reason it works early on is that you don't yet need a tech team, you need one person who can make the call and then go implement it. I'd rather help you stay small for longer than help you hire your way into complexity.",
    ),
    array(
        'q' => "Isn't all of this easier now that AI writes the code?",
        'a' => "Faster, yes — I use these tools every day and they've changed how I work. But building got cheap while judgment didn't. It's never been easier to ship something that demos beautifully and falls over the first time real users and real data arrive. That gap is most of my job now.",
    ),
    array(
        'q' => 'What does cobuild do?',
        'a' => "Some products are too ambitious for one person. That's why I founded cobuild — a SaaS product studio I run with a small group of senior engineers I've worked with for years. When a project needs more hands, it goes there, and I stay involved.",
    ),
    array(
        'q' => 'Where are you based?',
        'a' => 'Islamabad, Pakistan. I work remotely with teams across the globe and Europe, and I like coming by in person for a kickoff or team event.',
    ),
    array(
        'q' => 'How do engagements work?',
        'a' => "Ongoing part-time or scoped to a project, depending on what the product needs. Send me a short email at hey@sarmadgardezi.com telling me what you're building and what's in the way, and we'll take it from there on a call.",
    ),
);

if (function_exists('get_field')) {
    $acf_faq = get_field('faq_items');
    if (!empty($acf_faq) && is_array($acf_faq)) {
        $custom_faqs = array();
        foreach ($acf_faq as $item) {
            $q = is_array($item) ? ($item['question'] ?? $item['q'] ?? '') : '';
            $a = is_array($item) ? ($item['answer'] ?? $item['a'] ?? '') : '';
            if (!empty($q)) {
                $custom_faqs[] = array('q' => $q, 'a' => $a);
            }
        }
        if (!empty($custom_faqs)) {
            $faq_items = $custom_faqs;
        }
    }
}
?>

<section id="faq-section" class="faq-section" aria-label="<?php esc_attr_e('Frequently Asked Questions', 'sarmadgardezi'); ?>">
    <div class="site-container faq-container">
        
        <h2 class="reveal faq-section-heading" style="--stagger:14"><?php esc_html_e('FAQ', 'sarmadgardezi'); ?></h2>
        
        <dl class="faq-list">
            <?php foreach ($faq_items as $index => $item) : 
                $stagger = 15 + $index;
            ?>
                <div class="reveal faq-item" style="--stagger:<?php echo esc_attr($stagger); ?>">
                    <dt class="faq-question"><?php echo esc_html($item['q']); ?></dt>
                    <dd class="faq-answer"><?php echo esc_html($item['a']); ?></dd>
                </div>
            <?php endforeach; ?>
        </dl>

    </div>
</section>
