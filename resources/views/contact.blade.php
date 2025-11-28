<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyOpinion – Mail Writer</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>

    <!-- Quill Rich Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex">

    <!-- MOBILE HEADER -->
    <header class="md:hidden fixed top-0 left-0 right-0 bg-white shadow-lg z-50 p-4 flex items-center justify-between">
        <h1 class="font-semibold text-lg">MyOpinion Mail</h1>
        <button id="burger" class="text-2xl">☰</button>
    </header>

    <!-- SIDEBAR -->
    <aside id="sidebar" 
        class="fixed md:static top-0 left-0 h-full w-64 bg-white shadow-xl md:shadow-none 
               transform -translate-x-full md:translate-x-0 transition-all duration-300 z-40 p-6">

        <h2 class="text-xl font-semibold mb-6 hidden md:block">MyOpinion Mail</h2>

        <button class="w-full mb-6 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
            + Composer
        </button>

        <nav class="space-y-4 text-gray-700 text-sm">
            <p class="hover:text-indigo-600 cursor-pointer">📥 Réception</p>
            <p class="hover:text-indigo-600 cursor-pointer">📤 Envoyés</p>
            <p class="hover:text-indigo-600 cursor-pointer">📝 Brouillons</p>
            <p class="hover:text-indigo-600 cursor-pointer">🗑️ Corbeille</p>
        </nav>

        <div class="mt-auto pt-6 text-xs text-gray-500 hidden md:block">
            © {{ date('Y') }} MyOpinion
        </div>
    </aside>

    <!-- BACKDROP (mobile) -->
    <div id="backdrop" class="fixed inset-0 bg-black bg-opacity-40 hidden z-30"></div>

    <!-- MAIN -->
    <main class="flex-1 p-4 md:p-10 pt-20 md:pt-10">

        <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">

            <!-- HEADER -->
            <div class="p-4 border-b bg-gray-50">
                <h1 class="text-xl font-semibold text-gray-800">Rédiger un email</h1>
            </div>

            <!-- FORM -->
            <div class="p-6">

                @if(session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 border border-green-300 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('email.send') }}" class="space-y-6">
                    @csrf

                    <!-- TYPE DE MAIL -->
                    <div>
                        <label class="text-sm font-medium">Type de mail</label>
                        <select name="type" class="w-full mt-1 px-4 py-3 rounded-lg border focus:ring-indigo-500">
                            <option value="standard">Standard</option>
                            <option value="prospects">Prospects</option>
                            <option value="marketing">Marketing</option>
                            <option value="support">Support</option>
                            <option value="notification">Notification</option>
                        </select>
                    </div>

                    <!-- NOM -->
                    <div>
                        <label class="text-sm font-medium">Nom</label>
                        <input type="text" name="name"
                               class="w-full mt-1 px-4 py-3 rounded-lg border focus:ring-indigo-500"
                               placeholder="Votre nom">
                    </div>

                    <!-- EMAILS -->
                    <div>
                        <label class="text-sm font-medium">Liste d'emails</label>

                        <div id="emails-container" class="space-y-3 mt-2">
                            <div class="flex items-center gap-3">
                                <input type="email" name="emails[]" required
                                       class="flex-1 px-4 py-3 rounded-lg border focus:ring-indigo-500"
                                       placeholder="exemple@domaine.com">
                                <button class="hidden remove-email text-red-500 font-bold text-xl">×</button>
                            </div>
                        </div>

                        <button type="button" id="add-email"
                                class="mt-3 px-3 py-2 rounded-lg bg-indigo-50 text-indigo-700 border hover:bg-indigo-100">
                            + Ajouter un destinataire
                        </button>
                    </div>

                    <!-- ÉDITEUR (QUILL) -->
                    <div>
                        <label class="text-sm font-medium">Message</label>

                        <div id="editor" class="bg-white border rounded-lg h-48"></div>

                        <!-- Champ caché qui reçoit le HTML -->
                        <textarea name="message" id="message" class="hidden"></textarea>
                    </div>

                    <!-- BTN -->
                    <button type="submit"
                            class="w-full py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                        ✉️ Envoyer l’email
                    </button>
                </form>
            </div>
        </div>
    </main>


    <!-- SCRIPTS -->
    <script>
        /* --- MENU MOBILE --- */
        const sidebar = document.getElementById("sidebar");
        const burger = document.getElementById("burger");
        const backdrop = document.getElementById("backdrop");

        burger.addEventListener("click", () => {
            sidebar.classList.toggle("-translate-x-full");
            backdrop.classList.toggle("hidden");
        });

        backdrop.addEventListener("click", () => {
            sidebar.classList.add("-translate-x-full");
            backdrop.classList.add("hidden");
        });


        /* --- RICH TEXT EDITOR (QUILL) --- */
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Écris ton message ici...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ 'header': [1, 2, 3, false] }],
                    ['link', 'blockquote'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['clean']
                ]
            }
        });

        // Enregistrer le HTML dans un <textarea> avant l’envoi
        document.querySelector("form").addEventListener("submit", () => {
            document.getElementById("message").value = quill.root.innerHTML;
        });


        /* --- EMAILS DYNAMIQUES --- */
        const container = document.getElementById("emails-container");
        const addBtn = document.getElementById("add-email");

        addBtn.addEventListener("click", () => {
            if (container.querySelectorAll("input").length >= 10)
                return alert("Maximum 10 emails autorisés.");

            const div = document.createElement("div");
            div.className = "flex items-center gap-3";

            div.innerHTML = `
                <input type="email" name="emails[]" required
                       class="flex-1 px-4 py-3 rounded-lg border focus:ring-indigo-500"
                       placeholder="exemple@domaine.com">
                <button type="button" class="remove-email text-red-500 font-bold text-xl">×</button>
            `;
            container.appendChild(div);
        });

        container.addEventListener("click", e => {
            if (e.target.classList.contains("remove-email")) {
                e.target.parentElement.remove();
            }
        });
    </script>

</body>
</html>
