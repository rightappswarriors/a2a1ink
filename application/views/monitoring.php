<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AralLink Timekeeping Display</title>

	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}

		body {
			background: #f5f7fa;
			font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
			min-height: 100vh;
		}

		.page-header {
			background: linear-gradient(135deg, #2a5d84 0%, #1f3c52 100%);
			color: #fff;
			padding: 24px 30px;
			text-align: center;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
		}

		.page-header h1 {
			font-size: 1.75rem;
			font-weight: 600;
			margin-bottom: 4px;
		}

		.page-header .subtitle {
			font-size: 0.95rem;
			opacity: 0.9;
		}

		.container {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
			gap: 24px;
			padding: 30px;
			max-width: 1600px;
			margin: 0 auto;
		}

		.card {
			background: #fff;
			border-radius: 16px;
			overflow: hidden;
			box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
			transition: transform 0.2s ease, box-shadow 0.2s ease;
		}

		.card:hover {
			box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
		}

		.photo-wrapper {
			position: relative;
			padding-top: 75%;
			overflow: hidden;
		}

		.photo {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			object-fit: cover;
			border: 4px solid #fff;
			box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
		}

		.info {
			padding: 20px 22px 22px;
		}

		.info-row {
			display: flex;
			justify-content: space-between;
			padding: 10px 0;
			border-bottom: 1px solid #f0f0f0;
			font-size: 0.95rem;
		}

		.info-row:last-child {
			border-bottom: none;
		}

		.info-label {
			color: #666;
			font-weight: 500;
		}

		.info-value {
			color: #222;
			font-weight: 600;
		}

		.status-badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			padding: 4px 12px;
			border-radius: 20px;
			font-size: 0.85rem;
			font-weight: 600;
		}

		.status-badge.in {
			background: #e8f5e9;
			color: #2e7d32;
		}

		.status-badge.out {
			background: #ffebee;
			color: #c62828;
		}

		.status-dot {
			width: 8px;
			height: 8px;
			border-radius: 50%;
			background: currentColor;
			animation: pulse 2s infinite;
		}

		@keyframes pulse {
			0%, 100% { opacity: 1; }
			50% { opacity: 0.5; }
		}

		@media (max-width: 768px) {
			.container {
				padding: 20px 16px;
				gap: 16px;
			}

			.page-header {
				padding: 20px 16px;
			}

			.page-header h1 {
				font-size: 1.4rem;
			}

			.info {
				padding: 16px 18px 18px;
			}
		}

		@media (max-width: 480px) {
			.container {
				grid-template-columns: 1fr;
			}
		}
	</style>

</head>

<body>

	<header class="page-header">
		<h1>Timekeeping Display</h1>
		<p class="subtitle">Real-time attendance monitoring</p>
	</header>

	<div class="container" id="timekeeping-container"></div>


	<script>
		const container = document.getElementById("timekeeping-container");

		let lastData = new Map();

		async function getData() {
			try {
				const key = getKey();
				const response = await fetch(`monitoring/getdata?key=${key}`);
				const data = await response.json();
				return data.records || [];
			} catch (error) {
				console.error('Failed to fetch data:', error);
				return [];
			}
		}

		const getKey = () => {
			return new URLSearchParams(window.location.search).get('key');
		};

		async function renderCards() {
			const data = await getData();

			data.forEach(item => {

				const existing = lastData.get(item.id);

				if (!existing) {
					lastData.set(item.id, {
						id: item.id,
						photo: item.photo,
						name: item.name
					});

					createCard(item);
				}
				else {
					updateCard(item);
				}
			});
		}

		function createCard(d) {
			const card = document.createElement('div');
			card.className = 'card';
			card.dataset.id = d.id;

			card.innerHTML = `
				<div class="photo-wrapper">
					<img src="${d.photo}" class="photo" alt="${d.name}" />
				</div>

				<div class="info">
					<div class="info-row">
						<span class="info-label">Name</span>
						<span class="info-value">${d.name}</span>
					</div>

					<div class="info-row">
						<span class="info-label">ID</span>
						<span class="info-value">${d.id}</span>
					</div>

					<div class="info-row">
						<span class="info-label">Time</span>
						<span class="info-value time">${d.time}</span>
					</div>

					<div class="info-row">
						<span class="info-label">Date</span>
						<span class="info-value">${d.date}</span>
					</div>

					<div class="info-row">
						<span class="info-label">Status</span>
						<span class="status-badge ${d.status.toLowerCase()} status">
							<span class="status-dot"></span>
							${d.status}
						</span>
					</div>
				</div>
			`;

			container.appendChild(card);
		}

		function updateCard(d) {
			const card = document.querySelector(`[data-id="${d.id}"]`);
			if (!card) return;

			const timeEl = card.querySelector('.time');
			if (timeEl && timeEl.textContent !== d.time) {
				timeEl.textContent = d.time;
			}

			const statusEl = card.querySelector('.status');
			if (statusEl && statusEl.textContent.trim() !== d.status) {
				statusEl.className = `status-badge ${d.status.toLowerCase()} status`;
				statusEl.innerHTML = `
            <span class="status-dot"></span>
            ${d.status}
        `;
			}
		}

		renderCards();

		// refresh every 3 seconds
		setInterval(renderCards, 3000);
	</script>

</body>
</html>
