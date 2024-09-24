<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le titre de la page est dynamique, défini par la variable $pageTitle -->
    <title>GSB - <?php echo $pageTitle ?? 'Accueil'; ?></title>
    <!-- Inclusion de Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<!-- Utilisation des classes Tailwind pour le style de base -->
<body class="bg-gray-100">
<header class="bg-blue-600 text-white p-4">
    <h1 class="text-2xl font-bold">GSB - Gestion des visiteurs</h1>
</header>