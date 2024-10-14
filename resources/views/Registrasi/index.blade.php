<x-registrasilayout>
    <x-slot:title>Scan QR</x-slot:title>

    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Scan Undangan</h1>
        <button id="scanButton" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-500">
            Mulai Scan
        </button>
        <div id="result" class="mt-4"></div>
        <video id="videoPreview" style="display:none; width: 100%; border: 2px solid black; transform: scaleX(-1);"></video>
    </div>

    <script src="https://cdn.rawgit.com/cozmo/jsQR/master/dist/jsQR.js"></script>
    <script>
    if (typeof jsQR === 'undefined') {
        console.error('jsQR is not loaded');
    } else {
        let videoStream = null;

        document.getElementById('scanButton').addEventListener('click', function() {
            startCameraAndScan();
        });

        function startCameraAndScan() {
            navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } })
                .then(function(stream) {
                    videoStream = stream; 
                    const video = document.getElementById('videoPreview');
                    video.srcObject = stream; 
                    video.style.display = 'block'; 
                    video.play(); 
                    startScanning(); 
                })
                .catch(function(err) {
                    console.error("Error accessing camera: " + err);
                    alert('Kamera tidak dapat diakses. Pastikan izin telah diberikan.');
                });
        }

        function startScanning() {
            const video = document.getElementById('videoPreview');
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d', { willReadFrequently: true });

            function scan() {
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
                const code = jsQR(imageData.data, canvas.width, canvas.height);

                if (code) {
                    console.log('QR Code detected:', code.data);
                    fetchGuestData(code.data); 
                } else {
                    requestAnimationFrame(scan);
                }
            }

            video.onloadedmetadata = function() {
                canvas.width = video.videoWidth || 640;
                canvas.height = video.videoHeight || 480;
                scan(); 
            };
        }

        function fetchGuestData(qrData) {
            fetch(`/api/guest/${qrData}`)
                .then(response => {
                    console.log('API response:', response);
                    if (response.status === 400) {
                        return response.json().then(data => {
                            showAlert(data.message);
                            return Promise.reject();
                        });
                    }
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    if (data.tamu) {
                        showGuestData(data.tamu);
                    } else {
                        document.getElementById('result').innerHTML = data.message;
                    }
                })
                .catch(error => {
                    if (error) {
                        console.error('Error fetching guest data:', error);
                        document.getElementById('result').innerHTML = 'Error fetching guest data.';
                    }
                });
        }

        function showGuestData(tamu) {
            const content = `
                <div>
                    <p><strong>Nama:</strong> ${tamu.nama}</p>
                    <p><strong>Jenis Tamu:</strong> ${tamu.jenistamu}</p>
                    <p><strong>Instansi:</strong> ${tamu.instansi}</p>
                    <p><strong>Alamat:</strong> ${tamu.alamat}</p>
                    <button id="closePopup" class="bg-red-500 text-white px-2 py-1 rounded">Close</button>
                </div>
            `;

            const popup = document.createElement('div');
            popup.style.position = 'fixed';
            popup.style.top = '50%';
            popup.style.left = '50%';
            popup.style.transform = 'translate(-50%, -50%)';
            popup.style.backgroundColor = 'white';
            popup.style.border = '1px solid black';
            popup.style.padding = '20px';
            popup.style.zIndex = '1000'; 
            popup.innerHTML = content;
            document.body.appendChild(popup);

            document.getElementById('closePopup').addEventListener('click', function() {
                document.body.removeChild(popup);
                startCameraAndScan(); 
            });
        }

        function showAlert(message) {
            const alertDiv = document.createElement('div');
            alertDiv.innerHTML = message;
            alertDiv.classList.add('bg-white', 'p-4', 'rounded', 'shadow', 'fixed', 'top-1/2', 'left-1/2', '-translate-x-1/2', '-translate-y-1/2', 'z-10');

            const closeButton = document.createElement('button');
            closeButton.innerText = 'Close';
            closeButton.classList.add('mt-2', 'bg-red-500', 'text-white', 'px-2', 'py-1', 'rounded');
            closeButton.onclick = () => {
                alertDiv.remove();
                startCameraAndScan(); 
            };
            alertDiv.appendChild(closeButton);

            document.body.appendChild(alertDiv);
        }
    }
    </script>
</x-registrasilayout>
