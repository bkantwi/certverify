function handleVerify() {
    const id = document.getElementById('certId').value.trim();
    const loader = document.getElementById('loader');
    const modal = document.getElementById('certModal');
    const certFrame = document.getElementById('certFrame');
    const statusBadge = document.getElementById('statusBadge');
    const certIdText = document.getElementById('modalCertId');

    if (!id) {
        alert("Please enter a valid Certificate ID");
        return;
    }

    loader.style.display = 'block';
    modal.style.display = 'none';

    fetch('/verify-certificate', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ certificate_id: id })
    })
        .then(res => res.json())
        .then(data => {
            loader.style.display = 'none';
            certFrame.innerHTML = ''; // Clear previous content

            if (!data.status) {
                statusBadge.innerText = "✗ Invalid Certificate";
                statusBadge.style.background = "#EF4444";
                certIdText.innerText = "No Record Found";
                certFrame.innerHTML = '<p style="color: #666; padding: 20px;">The provided ID does not match our records.</p>';
            } else {
                certIdText.innerText = `ID: ${data.certificate_id}`;
                statusBadge.innerText = data.is_valid ? "✓ Verified Authentic" : "⚠ Suspended / Revoked";
                statusBadge.style.background = data.is_valid ? "#10B981" : "#F59E0B";

                // Check if file is PDF or Image
                const fileUrl = data.image;
                const isPDF = fileUrl.toLowerCase().endsWith('.pdf');

                if (isPDF) {
                    certFrame.innerHTML = `<iframe src="${fileUrl}" width="100%" height="500px" style="border:none; border-radius:8px;"></iframe>`;
                } else {
                    certFrame.innerHTML = `<img src="${fileUrl}" alt="Certificate Preview" style="width:100%; border-radius:8px;">`;
                }
            }
            modal.style.display = "flex";
        })
        .catch(err => {
            loader.style.display = 'none';
            console.error("Error:", err);
        });
}

function closeModal() {
    document.getElementById('certModal').style.display = "none";
}

window.onclick = function(event) {
    const modal = document.getElementById('certModal');
    if (event.target == modal) closeModal();
}
