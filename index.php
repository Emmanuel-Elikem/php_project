<?php
session_start();

$errors = $_SESSION['errors'] ?? [];
$old_data = $_SESSION['old_data'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['old_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .error-text {
            color: #dc2626; /* red-600 */
            font-size: 0.875rem; 
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="container mx-auto max-w-2xl px-4 py-12">
        <div class="bg-white rounded-lg shadow-xl p-8 md:p-12">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">Get In Touch</h1>
            <p class="text-gray-600 mb-8">We'd love to hear from you. Please fill out the form below.</p>

            <form action="process-form.php" method="POST" novalidate>
                <div class="space-y-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" placeholder="John Doe" required
                               value="<?php echo htmlspecialchars($old_data['name'] ?? ''); ?>"
                               class="w-full px-4 py-2 border <?php echo isset($errors['name']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                        <?php if (isset($errors['name'])): ?>
                            <p class="error-text mt-1"><?php echo $errors['name']; ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="you@example.com" required
                               value="<?php echo htmlspecialchars($old_data['email'] ?? ''); ?>"
                               class="w-full px-4 py-2 border <?php echo isset($errors['email']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                        <?php if (isset($errors['email'])): ?>
                            <p class="error-text mt-1"><?php echo $errors['email']; ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Subject Field -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Question about your services" required
                               value="<?php echo htmlspecialchars($old_data['subject'] ?? ''); ?>"
                               class="w-full px-4 py-2 border <?php echo isset($errors['subject']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out">
                        <?php if (isset($errors['subject'])): ?>
                            <p class="error-text mt-1"><?php echo $errors['subject']; ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Message Field -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="5" placeholder="Your message here..." required
                                  class="w-full px-4 py-2 border <?php echo isset($errors['message']) ? 'border-red-500' : 'border-gray-300'; ?> rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out"><?php echo htmlspecialchars($old_data['message'] ?? ''); ?></textarea>
                        <?php if (isset($errors['message'])): ?>
                            <p class="error-text mt-1"><?php echo $errors['message']; ?></p>
                        <?php endif; ?>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                            Send Message
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</body>
</html>

