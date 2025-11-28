<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOpinion – Mail Writer</title>

    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }

        .email-chip {
            @apply bg-indigo-100 text-indigo-700 px-2 py-1 rounded flex items-center gap-2 shadow-sm;
        }
        .chip-remove {
            @apply cursor-pointer font-bold hover:text-red-600;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex">

<!-- SIDEBAR -->
<aside id="sidebar"
    class="fixed md:static top-0 left-0 h-full w-64 bg-white shadow-xl md:shadow-none
           transform -translate-x-full md:translate-x-0 transition-all duration-300 z-40 p-6">

    <h2 class="text-xl font-semibold mb-6 hidden md:block">MyOpinion Mail</h2>

    <button
        class="w-full mb-6 px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
        + Composer
    </button>

    <nav class="space-y-4 text-gray-700 text-sm">
        <p class="hover:text-indigo-600 cursor-pointer">📥 Réception</p>
        <p class="hover:text-indigo-600 cursor-pointer">📤 Envoyés</p>
        <p class="hover:text-indigo-600 cursor-pointer">📝 Brouillons</p>
        <p class="hover:text-indigo-600 cursor-pointer">🗑️ Corbeille</p>
    </nav>
</aside>

<!-- MAIN -->
<main class="flex-1 p-4 md:p-10">

    <div class="bg-white shadow-xl rounded-2xl border border-gray-200 overflow-hidden">

        <!-- HEADER -->
        <div class="p-4 border-b bg-gray-50 flex items-center justify-between">
            <h1 class="text-xl font-semibold text-gray-800">Rédiger un email</h1>

            <!-- Type d'email -->
            <select name="type" form="send-mail-form"
                    class="px-3 py-2 rounded-lg border text-sm focus:ring-indigo-500">
                {{-- <option value="standard">Email Standard</option>
                <option value="prospects">Prospection</option> --}}
                <option value="marketing">Marketing</option>
                {{-- <option value="support">Support</option>
                <option value="notification">Notification</option> --}}
            </select>
        </div>

        <div class="p-6">
             @if(session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-800 border border-green-300 text-sm">
                        {{ session('success') }}
                    </div>
                @endif
            <form id="send-mail-form" method="POST" action="{{ route('email.send') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- OBJET -->
                <div>
                    <label class="text-sm font-medium">Objet</label>
                    <input type="text" name="subject"
                           class="w-full mt-2 px-4 py-3 rounded-lg border focus:ring-indigo-500"
                           placeholder="Objet de votre email..." required>
                </div>

                <!-- DESTINATAIRES -->
                <div>
                    <label class="text-sm font-medium">Destinataires</label>

                    <div id="emails-container" class="flex flex-wrap gap-2 mt-2 hidden"></div>

                    <input type="email" id="emails-input"
                           class="w-full mt-2 px-4 py-3 rounded-lg border focus:ring-indigo-500"
                           placeholder="email@domaine.com," autocomplete="off">
                </div>

                <!-- BOUTONS CC / BCC -->
                <div class="flex gap-4">
                    <button type="button" id="btn-cc"
                            class="px-3 py-2 rounded-lg bg-indigo-50 text-indigo-700 border hover:bg-indigo-100">
                        + Ajouter CC
                    </button>

                    <button type="button" id="btn-bcc"
                            class="px-3 py-2 rounded-lg bg-indigo-50 text-indigo-700 border hover:bg-indigo-100">
                        + Ajouter CCI
                    </button>
                </div>

                <!-- CC -->
                <div id="cc-section" class="hidden mt-3">
                    <label class="text-sm font-medium">Copie (CC)</label>

                    <div id="cc-container" class="flex flex-wrap gap-2 mt-2 hidden"></div>

                    <input type="email" id="cc-input"
                           class="w-full mt-2 px-4 py-3 rounded-lg border focus:ring-indigo-500"
                           placeholder="email@domaine.com," autocomplete="off">
                </div>

                <!-- BCC -->
                <div id="bcc-section" class="hidden mt-3">
                    <label class="text-sm font-medium">Copie cachée (CCI)</label>

                    <div id="bcc-container" class="flex flex-wrap gap-2 mt-2 hidden"></div>

                    <input type="email" id="bcc-input"
                           class="w-full mt-2 px-4 py-3 rounded-lg border focus:ring-indigo-500"
                           placeholder="email@domaine.com," autocomplete="off">
                </div>

                <!-- FICHIERS -->
                <div>
                    <label class="text-sm font-medium">Pièces jointes</label>
                    <input type="file" name="files[]" multiple
                           class="w-full mt-2 px-4 py-3 rounded-lg border bg-white">
                </div>

                <!-- MESSAGE -->
                <div>
                    <label class="text-sm font-medium">Message</label>
                    <div id="editor" class="bg-white border rounded-lg h-48"></div>
                    <textarea name="message" id="message" class="hidden"></textarea>
                </div>

                <button
                    class="w-full py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700">
                    ✉️ Envoyer
                </button>
            </form>
        </div>
    </div>
</main>

<script>
    /* --------------------------- EDITOR --------------------------- */
    const quill = new Quill('#editor', { theme: 'snow' });

    /* ---------------------- EMAILS DYNAMIQUES ---------------------- */
    function setupEmailField(inputId, containerId, sectionId = null) {
        const input = document.getElementById(inputId);
        const container = document.getElementById(containerId);
        const section = sectionId ? document.getElementById(sectionId) : null;

        let list = [];

        const isValidEmail = email => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);

        function render() {
            container.innerHTML = "";
            if (list.length > 0) container.classList.remove("hidden");
            else container.classList.add("hidden");

            list.forEach((email, index) => {
                const chip = document.createElement("span");
                chip.className = "email-chip";
                chip.innerHTML = `${email} <span class="chip-remove" data-index="${index}">✕</span>`;
                container.appendChild(chip);
            });

            if (section && list.length > 0)
                section.classList.remove("hidden");
        }

        input.addEventListener("keydown", e => {
            if (e.key === "," || e.key === "Enter") {
                e.preventDefault();
                const email = input.value.replace(",", "").trim();
                if (isValidEmail(email)) {
                    list.push(email);
                    render();
                }
                input.value = "";
            }
        });

        container.addEventListener("click", e => {
            if (e.target.classList.contains("chip-remove")) {
                list.splice(e.target.dataset.index, 1);
                render();
            }
        });

        return () => list;
    }

    /* Champs dynamiques */
    const emailsList = setupEmailField("emails-input", "emails-container");
    const ccList     = setupEmailField("cc-input", "cc-container", "cc-section");
    const bccList    = setupEmailField("bcc-input", "bcc-container", "bcc-section");

    /* CC / BCC toggle */
    document.getElementById("btn-cc").onclick = () =>
        document.getElementById("cc-section").classList.toggle("hidden");

    document.getElementById("btn-bcc").onclick = () =>
        document.getElementById("bcc-section").classList.toggle("hidden");

    /* ----------------------- FORM SUBMIT ------------------------ */
    document.querySelector("form").addEventListener("submit", e => {
        document.getElementById("message").value = quill.root.innerHTML;

        function appendHidden(name, arr) {
            arr().forEach(email => {
                const hidden = document.createElement("input");
                hidden.type = "hidden";
                hidden.name = name + "[]";
                hidden.value = email;
                e.target.appendChild(hidden);
            });
        }

        appendHidden("emails", emailsList);
        appendHidden("cc", ccList);
        appendHidden("bcc", bccList);
    });
</script>

</body>
</html>
