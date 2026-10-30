<?php
// Blog Manager - Clean, Simple & Human Interface
$blogsFile = __DIR__ . '/data/blogs.json';
$uploadDir = __DIR__ . '/assets/uploads/';

if (!file_exists(__DIR__ . '/data')) {
    mkdir(__DIR__ . '/data', 0777, true);
}
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

// Load blogs
$blogs = [];
if (file_exists($blogsFile)) {
    $blogs = json_decode(file_get_contents($blogsFile), true) ?: [];
}

$message = '';
$messageType = '';

// Check edit query
$editId = $_GET['edit'] ?? '';
$editingBlog = null;
if (!empty($editId)) {
    foreach ($blogs as $b) {
        if ((string)($b['id'] ?? '') === (string)$editId) {
            $editingBlog = $b;
            break;
        }
    }
}

// Handle POST actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // 1. ADD BLOG
    if ($action === 'add') {
        $title = trim($_POST['title'] ?? '');
        $desc = trim($_POST['desc'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $dateRaw = trim($_POST['date'] ?? '');
        $imageUrl = trim($_POST['image_url'] ?? '');
        $finalImage = '';

        // Check File Upload
        if (!empty($_FILES['image_file']['name']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['image_file']['tmp_name'];
            $fileName = basename($_FILES['image_file']['name']);
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            if (in_array($ext, $allowed)) {
                $newFileName = 'blog_' . time() . '_' . uniqid() . '.' . $ext;
                $targetFile = $uploadDir . $newFileName;
                if (move_uploaded_file($fileTmp, $targetFile)) {
                    $finalImage = './assets/uploads/' . $newFileName;
                }
            }
        }

        // Fallback to URL/Path
        if (empty($finalImage)) {
            $finalImage = !empty($imageUrl) ? $imageUrl : './assets/blog-1.png';
        }

        // Format Date
        $formattedDate = date('F j, Y');
        if (!empty($dateRaw)) {
            $timestamp = strtotime($dateRaw);
            $formattedDate = $timestamp ? date('F j, Y', $timestamp) : $dateRaw;
        }

        // SEO Fields
        $seoTitle = trim($_POST['seo_title'] ?? '');
        $seoDesc = trim($_POST['seo_desc'] ?? '');
        $seoUrl = trim($_POST['seo_url'] ?? '');

        // Generate friendly SEO URL if empty
        if (empty($seoUrl) && !empty($title)) {
            $seoUrl = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        if (!empty($title)) {
            $newBlog = [
                'id' => (string)(time() . rand(100, 999)),
                'image' => $finalImage,
                'date' => $formattedDate,
                'title' => $title,
                'desc' => $desc,
                'description' => $description,
                'seo_title' => $seoTitle,
                'seo_desc' => $seoDesc,
                'seo_url' => $seoUrl,
                'link' => !empty($seoUrl) ? '/blog/' . $seoUrl : '#blog-' . time()
            ];

            // Add to top of list
            array_unshift($blogs, $newBlog);
            file_put_contents($blogsFile, json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            header('Location: manage-blogs.php?status=added');
            exit;
        } else {
            $message = 'Please enter a title for the blog.';
            $messageType = 'error';
        }
    }

    // 2. EDIT BLOG
    if ($action === 'edit') {
        $updateId = (string)($_POST['blog_id'] ?? '');
        $title = trim($_POST['title'] ?? '');
        $desc = trim($_POST['desc'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $dateRaw = trim($_POST['date'] ?? '');
        $imageUrl = trim($_POST['image_url'] ?? '');
        $existingImage = trim($_POST['existing_image'] ?? '');
        $finalImage = $existingImage;

        // Check File Upload
        if (!empty($_FILES['image_file']['name']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $fileTmp = $_FILES['image_file']['tmp_name'];
            $fileName = basename($_FILES['image_file']['name']);
            $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            if (in_array($ext, $allowed)) {
                $newFileName = 'blog_' . time() . '_' . uniqid() . '.' . $ext;
                $targetFile = $uploadDir . $newFileName;
                if (move_uploaded_file($fileTmp, $targetFile)) {
                    $finalImage = './assets/uploads/' . $newFileName;
                }
            }
        } elseif (!empty($imageUrl)) {
            $finalImage = $imageUrl;
        }

        // Format Date
        $formattedDate = date('F j, Y');
        if (!empty($dateRaw)) {
            $timestamp = strtotime($dateRaw);
            $formattedDate = $timestamp ? date('F j, Y', $timestamp) : $dateRaw;
        }

        // SEO Fields
        $seoTitle = trim($_POST['seo_title'] ?? '');
        $seoDesc = trim($_POST['seo_desc'] ?? '');
        $seoUrl = trim($_POST['seo_url'] ?? '');

        if (empty($seoUrl) && !empty($title)) {
            $seoUrl = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title), '-'));
        }

        if (!empty($title) && !empty($updateId)) {
            foreach ($blogs as &$item) {
                if ((string)($item['id'] ?? '') === $updateId) {
                    $item['title'] = $title;
                    $item['desc'] = $desc;
                    $item['description'] = $description;
                    $item['date'] = $formattedDate;
                    if (!empty($finalImage)) {
                        $item['image'] = $finalImage;
                    }
                    $item['seo_title'] = $seoTitle;
                    $item['seo_desc'] = $seoDesc;
                    $item['seo_url'] = $seoUrl;
                    $item['link'] = !empty($seoUrl) ? '/blog/' . $seoUrl : '#blog-' . time();
                    break;
                }
            }
            unset($item);

            file_put_contents($blogsFile, json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            header('Location: manage-blogs.php?status=updated');
            exit;
        } else {
            $message = 'Please provide a valid blog title to update.';
            $messageType = 'error';
        }
    }

    // 3. DELETE BLOG
    if ($action === 'delete') {
        $deleteId = (string)($_POST['blog_id'] ?? '');
        if (!empty($deleteId)) {
            $blogs = array_values(array_filter($blogs, function($item) use ($deleteId) {
                return (string)($item['id'] ?? '') !== $deleteId;
            }));

            file_put_contents($blogsFile, json_encode($blogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));

            header('Location: manage-blogs.php?status=deleted');
            exit;
        }
    }
}

// Check status from URL
$status = $_GET['status'] ?? '';
if ($status === 'added') {
    $message = 'Blog post published successfully!';
    $messageType = 'success';
} elseif ($status === 'updated') {
    $message = 'Blog post updated successfully!';
    $messageType = 'success';
} elseif ($status === 'deleted') {
    $message = 'Blog post removed.';
    $messageType = 'success';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Manager</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./dist/output.css?v=<?= filemtime(__DIR__ . '/dist/output.css') ?>">
    <!-- TinyMCE Rich Text Editor -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.2/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body class="bg-slate-50 font-['Plus_Jakarta_Sans',sans-serif] text-slate-800 antialiased min-h-screen">

    <!-- Simple Top Bar -->
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="index.php" class="flex items-center">
                    <img src="/assets/img/logo.png" 
                         alt="Cleanergy" 
                         width="320"
                         height="160"
                         class="h-7 w-auto object-contain">
                </a>
                <span class="text-slate-300">/</span>
                <span class="text-sm font-medium text-slate-600">Blog Manager</span>
            </div>
            <a href="index.php#blogs" class="text-sm font-medium text-[#12b3d6] hover:text-[#0ea5e9] flex items-center gap-1 transition-colors">
                View on website ↗
            </a>
        </div>
    </header>

    <!-- Main Container -->
    <main class="max-w-5xl mx-auto px-4 sm:px-6 py-8 sm:py-10">

        <!-- Notification Message -->
        <?php if (!empty($message)): ?>
            <div class="mb-6 p-3.5 rounded-lg text-sm flex items-center justify-between <?= ($messageType === 'success') ? 'bg-emerald-50 text-emerald-800 border border-emerald-200' : 'bg-red-50 text-red-800 border border-red-200' ?>">
                <span><?= htmlspecialchars($message) ?></span>
                <a href="manage-blogs.php" class="text-xs opacity-60 hover:opacity-100 font-semibold ml-4">✕</a>
            </div>
        <?php endif; ?>

        <!-- Section 1: Create or Edit Blog Form -->
        <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 mb-10 shadow-xs">
            <div class="mb-6 pb-4 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-lg sm:text-xl font-bold text-slate-900">
                        <?= $editingBlog ? 'Edit Blog Post' : 'Create New Blog' ?>
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        <?= $editingBlog ? 'Update blog details and content below.' : 'Fill out the details below to add a blog to your website.' ?>
                    </p>
                </div>
                <?php if ($editingBlog): ?>
                    <a href="manage-blogs.php" class="px-3.5 py-1.5 rounded-lg border border-slate-300 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors">
                        Cancel Edit
                    </a>
                <?php endif; ?>
            </div>

            <form action="manage-blogs.php" method="POST" enctype="multipart/form-data" class="space-y-5">
                <input type="hidden" name="action" value="<?= $editingBlog ? 'edit' : 'add' ?>">
                <?php if ($editingBlog): ?>
                    <input type="hidden" name="blog_id" value="<?= htmlspecialchars((string)$editingBlog['id']) ?>">
                    <input type="hidden" name="existing_image" value="<?= htmlspecialchars($editingBlog['image'] ?? '') ?>">
                <?php endif; ?>

                <!-- Title & Date in a 2-col row -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Blog Title *</label>
                        <input type="text" 
                               name="title" 
                               value="<?= htmlspecialchars($editingBlog['title'] ?? '') ?>"
                               placeholder="e.g. How Many Ah Does an RV Battery Need?" 
                               required
                               class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-slate-300 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-[#12b3d6] focus:ring-1 focus:ring-[#12b3d6]">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1.5">Date</label>
                        <?php
                            $dateVal = date('Y-m-d');
                            if (!empty($editingBlog['date'])) {
                                $ts = strtotime($editingBlog['date']);
                                if ($ts) $dateVal = date('Y-m-d', $ts);
                            }
                        ?>
                        <input type="date" 
                               name="date" 
                               value="<?= htmlspecialchars($dateVal) ?>"
                               class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-slate-300 text-sm text-slate-900 focus:outline-none focus:border-[#12b3d6] focus:ring-1 focus:ring-[#12b3d6]">
                    </div>
                </div>

                <!-- Image: Simple Upload OR Link -->
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4">
                    <label class="block text-xs font-semibold text-slate-700 mb-2">Featured Image</label>
                    <?php if ($editingBlog && !empty($editingBlog['image'])): ?>
                        <div class="flex items-center gap-3 mb-3">
                            <img src="<?= htmlspecialchars($editingBlog['image']) ?>" alt="Current preview" class="w-16 h-12 object-cover rounded-md border border-slate-200 bg-white">
                            <span class="text-xs text-slate-500">Current: <?= htmlspecialchars($editingBlog['image']) ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 items-center">
                        <div>
                            <span class="text-xs text-slate-500 block mb-1">Upload new from computer:</span>
                            <input type="file" 
                                   name="image_file" 
                                   accept="image/*"
                                   class="block w-full text-xs text-slate-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-medium file:bg-white file:text-slate-700 file:border file:border-slate-300 hover:file:bg-slate-100 cursor-pointer">
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block mb-1">Or paste image URL / path:</span>
                            <input type="text" 
                                   name="image_url" 
                                   value="<?= htmlspecialchars($editingBlog['image'] ?? '') ?>"
                                   placeholder="./assets/img/blog-rv-battery.webp or https://..."
                                   class="w-full px-3 py-2 rounded-lg bg-white border border-slate-300 text-xs text-slate-900 placeholder-slate-400 focus:outline-none focus:border-[#12b3d6]">
                        </div>
                    </div>
                </div>

                <!-- Short Description -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Short Description</label>
                    <textarea name="desc" 
                              rows="3" 
                              placeholder="A short summary of the blog post (shown on cards and previews)..."
                              class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-slate-300 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-[#12b3d6] focus:ring-1 focus:ring-[#12b3d6] resize-none"><?= htmlspecialchars($editingBlog['desc'] ?? '') ?></textarea>
                </div>

                <!-- Description (Full Blog Content - Rich Text) -->
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-slate-700">Description (Full Blog Detailed Content)</label>
                        <span class="text-[11px] text-slate-400">Displays on the blog's detailed page</span>
                    </div>
                    <textarea name="description" 
                              id="blog_description" 
                              rows="18" 
                              placeholder="Write or paste full detailed article content here..."
                              class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-slate-300 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-[#12b3d6]"><?= htmlspecialchars($editingBlog['description'] ?? '') ?></textarea>
                </div>

                <!-- SEO Heading -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">SEO Heading</label>
                    <input type="text" 
                           name="seo_title" 
                           value="<?= htmlspecialchars($editingBlog['seo_title'] ?? '') ?>"
                           placeholder="SEO heading for search engines..." 
                           class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-slate-300 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-[#12b3d6] focus:ring-1 focus:ring-[#12b3d6]">
                </div>

                <!-- SEO Description -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">SEO Description</label>
                    <textarea name="seo_desc" 
                              rows="2" 
                              placeholder="SEO description for search engines..."
                              class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-slate-300 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-[#12b3d6] focus:ring-1 focus:ring-[#12b3d6] resize-none"><?= htmlspecialchars($editingBlog['seo_desc'] ?? '') ?></textarea>
                </div>

                <!-- SEO URL -->
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">SEO URL (Slug)</label>
                    <input type="text" 
                           name="seo_url" 
                           value="<?= htmlspecialchars($editingBlog['seo_url'] ?? '') ?>"
                           placeholder="e.g. how-many-ah-does-an-rv-battery-need" 
                           class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-slate-300 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:border-[#12b3d6] focus:ring-1 focus:ring-[#12b3d6]">
                </div>

                <!-- Submit Button -->
                <div class="pt-2 flex items-center justify-between">
                    <span class="text-xs text-slate-400">"Read More" link will open detailed page with this content.</span>
                    <button type="submit" 
                            class="px-6 py-2.5 rounded-lg bg-[#12b3d6] hover:bg-[#0ea5e9] text-white text-sm font-semibold transition-colors cursor-pointer shadow-xs">
                        <?= $editingBlog ? 'Update Blog Post' : 'Publish Blog' ?>
                    </button>
                </div>
            </form>
        </div>

        <!-- Section 2: Manage Existing Blogs List -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base font-bold text-slate-900">
                    Existing Blogs <span class="text-slate-500 text-xs font-normal">(<?= count($blogs) ?> total)</span>
                </h3>
            </div>

            <?php if (empty($blogs)): ?>
                <div class="bg-white rounded-xl border border-slate-200 p-8 text-center text-sm text-slate-500">
                    No blogs found. Add your first blog using the form above.
                </div>
            <?php else: ?>
                <div class="bg-white rounded-2xl border border-slate-200 divide-y divide-slate-100 overflow-hidden shadow-xs">
                    <?php foreach ($blogs as $blog): ?>
                        <div class="p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 hover:bg-slate-50/70 transition-colors">
                            
                            <!-- Thumbnail & Info -->
                            <div class="flex items-start sm:items-center gap-4 flex-1 min-w-0">
                                <img src="<?= htmlspecialchars($blog['image'] ?? './assets/blog-1.png') ?>" 
                                     alt="" 
                                     class="w-20 h-16 sm:w-24 sm:h-18 object-cover rounded-lg border border-slate-200 shrink-0 bg-slate-100">
                                
                                <div class="min-w-0 flex-1">
                                    <span class="text-xs font-medium text-[#12b3d6] block mb-0.5">
                                        <?= htmlspecialchars($blog['date'] ?? '') ?>
                                    </span>
                                    <h4 class="font-bold text-slate-900 text-sm sm:text-base truncate mb-1">
                                        <?= htmlspecialchars($blog['title'] ?? '') ?>
                                    </h4>
                                    <p class="text-xs text-slate-500 line-clamp-1 max-w-xl">
                                        <?= htmlspecialchars($blog['desc'] ?? '') ?>
                                    </p>
                                    <div class="flex items-center gap-3 mt-1.5 flex-wrap">
                                        <?php if (!empty($blog['seo_url'])): ?>
                                            <a href="/blog/<?= htmlspecialchars($blog['seo_url']) ?>" target="_blank" class="text-[11px] text-[#12b3d6] hover:underline font-mono">
                                                🔗 /blog/<?= htmlspecialchars($blog['seo_url']) ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions: Edit & Delete -->
                            <div class="shrink-0 self-end sm:self-center flex items-center gap-2">
                                <a href="manage-blogs.php?edit=<?= htmlspecialchars((string)($blog['id'] ?? '')) ?>" 
                                   class="px-3 py-1.5 text-xs font-medium text-sky-700 hover:text-sky-800 hover:bg-sky-50 rounded-md border border-sky-200 transition-colors">
                                    Edit
                                </a>
                                <form action="manage-blogs.php" method="POST" onsubmit="return confirm('Delete this blog?');" class="inline">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="blog_id" value="<?= htmlspecialchars((string)($blog['id'] ?? '')) ?>">
                                    <button type="submit" 
                                            class="px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md border border-red-200 transition-colors cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

    </main>

    <!-- Initialize TinyMCE Rich Text Editor -->
    <style>
        .tox-promotion,
        .tox-statusbar__branding,
        .tox-statusbar__path-item--upgrade,
        .tox-button--upgrade {
            display: none !important;
        }
    </style>
    <script>
        tinymce.init({
            selector: '#blog_description',
            height: 500,
            promotion: false,
            branding: false,
            menubar: 'file edit view insert format tools table help',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | link image media table | charmap emoticons | hr pagebreak | ' +
                'preview fullscreen | code | help',
            content_style: 'body { font-family: "Plus Jakarta Sans", Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; font-size: 14px; line-height: 1.6; color: #1e293b; padding: 12px; }'
        });
    </script>
</body>
</html>
