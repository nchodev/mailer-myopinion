<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>MyOpinion – Mail Writer</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
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

    <!-- BACKDROP -->
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

                <form method="POST" action="{{ route('email.send') }}" enctype="multipart/form-data" class="space-y-6">
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

                    <!-- EMAILS -->
                    <div>
                        <label class="text-sm font-medium">Liste d'emails</label>
                        <input type="text" id="emails-input"
                               class="w-full mt-2 px-4 py-3 rounded-lg border focus:ring-indigo-500"
                               placeholder="exemple@domaine.com, test@domaine.com">
                        <small class="text-gray-400 text-xs">Séparez plusieurs emails par une virgule.</small>
                    </div>

                    <!-- BOUTONS CC / CCI -->
                    <div class="flex gap-4 mt-2">
                        <button type="button" id="show-cc"
                                class="px-3 py-2 rounded-lg bg-indigo-50 text-indigo-700 border hover:bg-indigo-100">
                            + Ajouter CC
                        </button>
                        <button type="button" id="show-bcc"
                                class="px-3 py-2 rounded-lg bg-indigo-50 text-indigo-700 border hover:bg-indigo-100">
                            + Ajouter CCI
                        </button>
                    </div>

                    <!-- CC -->
                    <div id="cc-container" class="space-y-3 mt-2 hidden">
                        <input type="text" name="cc-input" placeholder="email1@domaine.com, email2@domaine.com"
                               class="w-full px-4 py-3 rounded-lg border focus:ring-indigo-500">
                    </div>

                    <!-- CCI -->
                    <div id="bcc-container" class="space-y-3 mt-2 hidden">
                        <input type="text" name="bcc-input" placeholder="email1@domaine.com, email2@domaine.com"
                               class="w-full px-4 py-3 rounded-lg border focus:ring-indigo-500">
                    </div>

                    <!-- FICHIERS -->
                    <div>
                        <label class="text-sm font-medium">Pièces jointes</label>
                        <input type="file" name="files[]" multiple
                               class="w-full mt-2 px-4 py-3 rounded-lg border bg-white focus:ring-indigo-500">
                    </div>

                    <!-- MESSAGE -->
                    <div>
                        <label class="text-sm font-medium">Message</label>
                        <div id="editor" class="bg-white border rounded-lg h-48"></div>
                        <textarea name="message" id="message" class="hidden"></textarea>
                    </div>

                    <button type="submit"
                            class="w-full py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                        ✉️ Envoyer l’email
                    </button>
                </form>
            </div>
        </div>
    </main>

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

    /* --- Quill --- */
    const quill = new Quill('#editor', {
        theme: 'snow',
        placeholder: 'Écris ton message ici...',
        modules: { toolbar: [['bold','italic','underline'], [{header:[1,2,3,false]}], ['link','blockquote'], [{list:'ordered'}, {list:'bullet'}], ['clean']] }
    });

    /* --- Afficher CC / CCI --- */
    document.getElementById("show-cc").addEventListener("click", () => {
        document.getElementById("cc-container").classList.toggle("hidden");
    });
    document.getElementById("show-bcc").addEventListener("click", () => {
        document.getElementById("bcc-container").classList.toggle("hidden");
    });

    /* --- Soumission formulaire --- */
    document.querySelector("form").addEventListener("submit", e => {
        document.getElementById("message").value = quill.root.innerHTML;

        const emailsInput = document.getElementById("emails-input").value;
        const ccInput = document.querySelector("input[name='cc-input']")?.value || '';
        const bccInput = document.querySelector("input[name='bcc-input']")?.value || '';

        function createHidden(name, str) {
            const arr = str.split(',').map(e => e.trim()).filter(e => e);
            arr.forEach(email => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = name + '[]';
                input.value = email;
                e.target.appendChild(input);
            });
        }

        createHidden('emails', emailsInput);
        createHidden('cc', ccInput);
        createHidden('bcc', bccInput);
    });
</script>

</body>
</html>
