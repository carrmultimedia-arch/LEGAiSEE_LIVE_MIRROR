<?php
// ai-platforms.php - AI Platform Selector
// Save to your server and access via browser

$platforms = [
    'free' => [
        [
            'name' => 'ChatGPT',
            'provider' => 'OpenAI',
            'type' => 'Chat',
            'url' => 'https://chat.openai.com',
            'description' => 'General-purpose conversational AI',
            'features' => ['GPT-4o mini', 'Web search', 'Code interpreter', 'File upload'],
            'limits' => '40 messages/3hrs (free tier)',
            'icon' => '💬'
        ],
        [
            'name' => 'Claude',
            'provider' => 'Anthropic',
            'type' => 'Chat',
            'url' => 'https://claude.ai',
            'description' => 'Long-context reasoning assistant',
            'features' => ['Claude 3.5 Sonnet', '200K context', 'Artifacts', 'Vision'],
            'limits' => 'Rate limited (free tier)',
            'icon' => '🧠'
        ],
        [
            'name' => 'Gemini',
            'provider' => 'Google',
            'type' => 'Chat',
            'url' => 'https://gemini.google.com',
            'description' => 'Multimodal Google AI',
            'features' => ['Gemini 1.5 Flash', 'YouTube integration', 'Gmail/ Docs', '2M context'],
            'limits' => '60 queries/min (free)',
            'icon' => '♊'
        ],
        [
            'name' => 'Perplexity',
            'provider' => 'Perplexity AI',
            'type' => 'Search',
            'url' => 'https://perplexity.ai',
            'description' => 'AI-powered search engine',
            'features' => ['Real-time search', 'Source citations', 'Pro search', 'Copilot'],
            'limits' => '5 Copilots/day (free)',
            'icon' => '🔍'
        ],
        [
            'name' => 'HuggingChat',
            'provider' => 'Hugging Face',
            'type' => 'Chat',
            'url' => 'https://huggingface.co/chat',
            'description' => 'Open model aggregator',
            'features' => ['Llama 3', 'Mistral', 'Command R+', 'Mixtral'],
            'limits' => 'Unlimited (community)',
            'icon' => '🤗'
        ],
        [
            'name' => 'Poe',
            'provider' => 'Quora',
            'type' => 'Aggregator',
            'url' => 'https://poe.com',
            'description' => 'Multi-bot chat platform',
            'features' => ['GPT-4', 'Claude', 'Gemini', 'Custom bots'],
            'limits' => 'Limited daily messages',
            'icon' => '📱'
        ]
    ],
    'paid' => [
        [
            'name' => 'ChatGPT Plus',
            'provider' => 'OpenAI',
            'type' => 'Chat',
            'url' => 'https://chat.openai.com',
            'price' => '$20/month',
            'description' => 'Full GPT-4o access',
            'features' => ['GPT-4o unlimited', 'DALL-E 3', 'Custom GPTs', 'Priority access'],
            'icon' => '💬'
        ],
        [
            'name' => 'Claude Pro',
            'provider' => 'Anthropic',
            'type' => 'Chat',
            'url' => 'https://claude.ai',
            'price' => '$20/month',
            'description' => '5x usage vs free',
            'features' => ['Claude 3.5 Opus', 'Higher limits', 'Early access', 'Priority bandwidth'],
            'icon' => '🧠'
        ],
        [
            'name' => 'Gemini Advanced',
            'provider' => 'Google',
            'type' => 'Chat',
            'url' => 'https://gemini.google.com/advanced',
            'price' => '$19.99/month',
            'description' => '1.5 Pro + 2TB storage',
            'features' => ['Gemini 1.5 Pro', '2TB Google One', 'Workspace integration', 'Priority support'],
            'icon' => '♊'
        ],
        [
            'name' => 'Perplexity Pro',
            'provider' => 'Perplexity AI',
            'type' => 'Search',
            'url' => 'https://perplexity.ai/pro',
            'price' => '$20/month',
            'description' => 'Unlimited Copilot + API',
            'features' => ['Unlimited Copilot', 'GPT-4/Claude/Gemini', 'File upload', 'API access'],
            'icon' => '🔍'
        ],
        [
            'name' => 'Midjourney',
            'provider' => 'Midjourney',
            'type' => 'Image',
            'url' => 'https://midjourney.com',
            'price' => '$10-120/month',
            'description' => 'Best-in-class image generation',
            'features' => ['V6 rendering', 'Style tuning', 'Pan/zoom', 'Private mode'],
            'icon' => '🎨'
        ],
        [
            'name' => 'GitHub Copilot',
            'provider' => 'GitHub',
            'type' => 'Code',
            'url' => 'https://github.com/copilot',
            'price' => '$10/month',
            'description' => 'AI pair programmer',
            'features' => ['Code completion', 'Chat in IDE', 'PR summaries', 'Terminal assist'],
            'icon' => '💻'
        ]
    ],
    'api' => [
        [
            'name' => 'OpenAI API',
            'provider' => 'OpenAI',
            'type' => 'API',
            'url' => 'https://platform.openai.com',
            'price' => 'Pay-per-use',
            'description' => 'GPT-4, DALL-E, Whisper, TTS',
            'features' => ['GPT-4o', 'GPT-4 Turbo', 'DALL-E 3', 'Embeddings'],
            'pricing' => 'Input: $5/1M tokens (4o)',
            'icon' => '🔌'
        ],
        [
            'name' => 'Anthropic API',
            'provider' => 'Anthropic',
            'type' => 'API',
            'url' => 'https://console.anthropic.com',
            'price' => 'Pay-per-use',
            'description' => 'Claude models for developers',
            'features' => ['Claude 3.5 Sonnet', 'Claude 3 Opus', '200K context', 'Tool use'],
            'pricing' => 'Input: $3/1M tokens (Sonnet)',
            'icon' => '🔌'
        ],
        [
            'name' => 'Google AI Studio',
            'provider' => 'Google',
            'type' => 'API',
            'url' => 'https://aistudio.google.com',
            'price' => 'Pay-per-use',
            'description' => 'Gemini API + free tier',
            'features' => ['Gemini 1.5 Pro', '1.5 Flash', 'Vision', 'Function calling'],
            'pricing' => 'Free tier: 60 queries/min',
            'icon' => '🔌'
        ],
        [
            'name' => 'Groq',
            'provider' => 'Groq',
            'type' => 'API',
            'url' => 'https://groq.com',
            'price' => 'Pay-per-use',
            'description' => 'Fastest inference (LPUs)',
            'features' => ['Llama 3 70B', 'Mixtral 8x22B', '<100ms latency', 'OpenAI-compatible'],
            'pricing' => 'Input: $0.59/1M tokens (Llama)',
            'icon' => '⚡'
        ],
        [
            'name' => 'Together AI',
            'provider' => 'Together',
            'type' => 'API',
            'url' => 'https://together.ai',
            'price' => 'Pay-per-use',
            'description' => 'Open model inference',
            'features' => ['100+ open models', 'Fine-tuning', 'Serverless', 'Dedicated'],
            'pricing' => 'From $0.10/1M tokens',
            'icon' => '🔌'
        ],
        [
            'name' => 'Replicate',
            'provider' => 'Replicate',
            'type' => 'API',
            'url' => 'https://replicate.com',
            'price' => 'Pay-per-use',
            'description' => 'Run any open-source model',
            'features' => ['Image gen', 'Video gen', 'Audio', 'Custom models'],
            'pricing' => 'Per-second GPU billing',
            'icon' => '🔌'
        ]
    ]
];

$selected = $_GET['platform'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Platform Selector</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #0a0a0f;
            color: #e0e0e0;
            min-height: 100vh;
            padding: 2rem;
        }
        .header {
            text-align: center;
            margin-bottom: 3rem;
        }
        .header h1 {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }
        .header p { color: #888; font-size: 1.1rem; }
        
        .columns {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .column {
            background: rgba(255,255,255,0.03);
            border-radius: 16px;
            padding: 1.5rem;
            border: 1px solid rgba(255,255,255,0.06);
        }
        
        .column-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .column-header h2 {
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .badge-free { background: #059669; color: white; }
        .badge-paid { background: #dc2626; color: white; }
        .badge-api { background: #7c3aed; color: white; }
        
        .platform-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.2s ease;
            position: relative;
            overflow: hidden;
        }
        
        .platform-card:hover {
            background: rgba(255,255,255,0.08);
            border-color: rgba(102, 126, 234, 0.4);
            transform: translateY(-2px);
        }
        
        .platform-card.selected {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.1);
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.2);
        }
        
        .platform-card.selected::after {
            content: '✓';
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background: #667eea;
            color: white;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.875rem;
            font-weight: bold;
        }
        
        .card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.5rem;
        }
        
        .card-icon {
            font-size: 1.5rem;
        }
        
        .card-title {
            font-size: 1rem;
            font-weight: 600;
        }
        
        .card-provider {
            font-size: 0.8rem;
            color: #888;
        }
        
        .card-type {
            display: inline-block;
            padding: 0.15rem 0.5rem;
            background: rgba(255,255,255,0.1);
            border-radius: 4px;
            font-size: 0.7rem;
            margin-left: auto;
            text-transform: uppercase;
        }
        
        .card-description {
            color: #aaa;
            font-size: 0.875rem;
            margin: 0.75rem 0;
            line-height: 1.4;
        }
        
        .card-features {
            list-style: none;
            margin: 0.75rem 0;
        }
        
        .card-features li {
            font-size: 0.8rem;
            color: #bbb;
            padding: 0.2rem 0;
            padding-left: 1rem;
            position: relative;
        }
        
        .card-features li::before {
            content: '›';
            position: absolute;
            left: 0;
            color: #667eea;
        }
        
        .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid rgba(255,255,255,0.06);
            font-size: 0.8rem;
        }
        
        .card-price {
            color: #fbbf24;
            font-weight: 600;
        }
        
        .card-limit {
            color: #888;
        }
        
        .launch-btn {
            display: block;
            width: 100%;
            padding: 0.75rem;
            margin-top: 0.75rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.2s ease;
            text-decoration: none;
            text-align: center;
        }
        
        .platform-card.selected .launch-btn {
            opacity: 1;
            transform: translateY(0);
        }
        
        .launch-btn:hover {
            filter: brightness(1.2);
        }
        
        .selection-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(10, 10, 15, 0.95);
            backdrop-filter: blur(10px);
            border-top: 1px solid rgba(255,255,255,0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transform: translateY(100%);
            transition: transform 0.3s ease;
            z-index: 100;
        }
        
        .selection-bar.active {
            transform: translateY(0);
        }
        
        .selection-info {
            display: flex;
            gap: 1rem;
            align-items: center;
        }
        
        .selection-count {
            background: #667eea;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }
        
        .clear-btn {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: #888;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            cursor: pointer;
        }
        
        .clear-btn:hover {
            border-color: #dc2626;
            color: #dc2626;
        }
        
        @media (max-width: 768px) {
            .columns { grid-template-columns: 1fr; }
            body { padding: 1rem; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>AI Platform Selector</h1>
        <p>Choose your tools. Free, paid, or API — all in one place.</p>
    </div>
    
    <div class="columns">
        <?php foreach ($platforms as $tier => $items): ?>
        <div class="column">
            <div class="column-header">
                <h2><?php echo ucfirst($tier); ?></h2>
                <span class="badge badge-<?php echo $tier; ?>">
                    <?php echo count($items); ?> platforms
                </span>
            </div>
            
            <?php foreach ($items as $platform): 
                $isSelected = $selected === $platform['name'];
            ?>
            <div class="platform-card <?php echo $isSelected ? 'selected' : ''; ?>" 
                 data-name="<?php echo htmlspecialchars($platform['name']); ?>"
                 data-url="<?php echo htmlspecialchars($platform['url']); ?>"
                 onclick="toggleSelect(this)">
                
                <div class="card-header">
                    <span class="card-icon"><?php echo $platform['icon']; ?></span>
                    <div>
                        <div class="card-title"><?php echo $platform['name']; ?></div>
                        <div class="card-provider"><?php echo $platform['provider']; ?></div>
                    </div>
                    <span class="card-type"><?php echo $platform['type']; ?></span>
                </div>
                
                <div class="card-description"><?php echo $platform['description']; ?></div>
                
                <ul class="card-features">
                    <?php foreach ($platform['features'] as $feature): ?>
                    <li><?php echo $feature; ?></li>
                    <?php endforeach; ?>
                </ul>
                
                <div class="card-meta">
                    <?php if (isset($platform['price'])): ?>
                    <span class="card-price"><?php echo $platform['price']; ?></span>
                    <?php endif; ?>
                    <?php if (isset($platform['limits'])): ?>
                    <span class="card-limit"><?php echo $platform['limits']; ?></span>
                    <?php endif; ?>
                    <?php if (isset($platform['pricing'])): ?>
                    <span class="card-limit"><?php echo $platform['pricing']; ?></span>
                    <?php endif; ?>
                </div>
                
                <a href="<?php echo $platform['url']; ?>" target="_blank" class="launch-btn" onclick="event.stopPropagation()">
                    Launch →
                </a>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="selection-bar" id="selectionBar">
        <div class="selection-info">
            <div class="selection-count" id="selectionCount">0</div>
            <div>
                <div style="font-weight: 600;">Platforms selected</div>
                <div style="font-size: 0.8rem; color: #888;">Click to compare or launch</div>
            </div>
        </div>
        <button class="clear-btn" onclick="clearSelection()">Clear all</button>
    </div>

    <script>
        let selected = new Set();
        
        function toggleSelect(card) {
            const name = card.dataset.name;
            const url = card.dataset.url;
            
            if (selected.has(name)) {
                selected.delete(name);
                card.classList.remove('selected');
            } else {
                selected.add(name);
                card.classList.add('selected');
            }
            
            updateSelectionBar();
        }
        
        function updateSelectionBar() {
            const bar = document.getElementById('selectionBar');
            const count = document.getElementById('selectionCount');
            
            count.textContent = selected.size;
            
            if (selected.size > 0) {
                bar.classList.add('active');
            } else {
                bar.classList.remove('active');
            }
        }
        
        function clearSelection() {
            selected.clear();
            document.querySelectorAll('.platform-card.selected').forEach(card => {
                card.classList.remove('selected');
            });
            updateSelectionBar();
        }
        
        // Persist selection in URL for sharing
        function updateURL() {
            const params = new URLSearchParams();
            if (selected.size > 0) {
                params.set('platform', Array.from(selected).join(','));
            }
            window.history.replaceState({}, '', '?' + params.toString());
        }
        
        // Keyboard shortcut: Escape clears
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') clearSelection();
        });
    </script>
</body>
</html>
