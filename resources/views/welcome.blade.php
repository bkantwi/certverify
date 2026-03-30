@extends('layouts.app')
@section('content')
    <section class="hero-section">
        <h1>Verify Excellence <span>Instantly.</span></h1>
        <p>Enter the unique certificate identification number to validate credentials and view the official digital copy.</p>
    </section>

    <div class="search-container">
        <div class="input-group">
            <input type="text" id="certId" placeholder="Enter Certificate ID (e.g. ABC-123)" autocomplete="off">
            <button class="verify-btn" onclick="handleVerify()">Verify Now</button>
        </div>
        <div class="loader" id="loader"></div>
    </div>

    <div id="certModal" class="modal-overlay">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>

            <div style="text-align: center;">
                <span id="statusBadge" class="status-badge">Verifying...</span>
                <h3 id="modalCertId" style="margin-bottom: 1.5rem; color: var(--primary-yellow);">ID: </h3>
            </div>

            <div class="certificate-frame" id="certFrame">
            </div>
        </div>
    </div>

    {{-- <script>
        function handleVerify() {
            const certId = document.getElementById('certId').value.trim();
            if (!certId) return;

            document.getElementById('loader').style.display = 'block';
            document.getElementById('certModal').style.display = 'flex';

            fetch(`/verify-certificate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ certificate_id: certId })
            })
                .then(res => res.json())
                .then(data => {
                    document.getElementById('loader').style.display = 'none';
                    const badge = document.getElementById('statusBadge');
                    const frame = document.getElementById('certFrame');
                    document.getElementById('modalCertId').textContent = 'ID: ' + certId;

                    if (!data.status) {
                        badge.textContent = 'Not Found';
                        badge.className = 'status-badge invalid';
                        frame.innerHTML = `<p style="text-align:center; color: red;">${data.message}</p>`;
                        return;
                    }

                    badge.textContent = data.is_valid ? 'Valid' : 'Invalid';
                    badge.className = 'status-badge ' + (data.is_valid ? 'valid' : 'invalid');

                    // Render PDF or image based on file type
                    if (data.file_type === 'pdf') {
                        frame.innerHTML = `<iframe src="${data.image}" style="width:100%; height:600px; border:none;"></iframe>`;
                    } else {
                        frame.innerHTML = `<img src="${data.image}" style="width:100%; border-radius:8px;" />`;
                    }
                })
                .catch(() => {
                    document.getElementById('loader').style.display = 'none';
                    alert('Something went wrong. Please try again.');
                });
        }

        function closeModal() {
            document.getElementById('certModal').style.display = 'none';
        }
    </script> --}}
@endsection
