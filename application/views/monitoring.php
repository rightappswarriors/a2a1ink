<?php $this->load->view('components/monitoring_header'); ?>

	<div class="wrapper">
		<div class="container" id="timekeeping-container"></div>
	</div>

	<script>
		const container = document.getElementById("timekeeping-container");
		const BASE_URL = "<?= site_url() ?>";
		const KEY = "<?= $key ?>";

		let lastData = new Map();

		async function getData() {
			try {
				const response = await fetch(`${BASE_URL}monitoring/getdata/${KEY}`);
				const data = await response.json();
				return data.records || [];
			} catch (error) {
				console.error('Failed to fetch data:', error);
				return [];
			}
		}

		async function renderCards() {
			const data = await getData();

			data.forEach(item => {

				const existing = lastData.get(item.cn_cardno);

				if (!existing) {
					lastData.set(item.cn_cardno, {
						id: item.cn_cardno,
						photo: item.photo,
						name: item.consumer
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
			card.dataset.id = d.cn_cardno;

			card.innerHTML = `
				<div class="photo-wrapper">
					<img src="${d.photo}" class="photo" alt="${d.consumer}" />
				</div>

				<div class="info">
					<div class="info-row">
						<span class="info-label">Name</span>
						<span class="info-value">${d.consumer}</span>
					</div>

					<div class="info-row">
						<span class="info-label">ID</span>
						<span class="info-value">${d.cn_cardno}</span>
					</div>

					<div class="info-row">
						<span class="info-label">Time</span>
						<span class="info-value time">${parseTime(d.logdatetime)}</span>
					</div>

					<div class="info-row">
						<span class="info-label">Date</span>
						<span class="info-value">${d.logdate}</span>
					</div>

					<div class="info-row">
						<span class="info-label">Direction</span>
						<span class="status-badge ${d.direction.toLowerCase()} status">
							<span class="status-dot"></span>
							${capitalize(d.direction)}
						</span>
					</div>
				</div>
				`;

			container.appendChild(card);
		}

		function updateCard(d) {
			const card = document.querySelector(`[data-id="${d.cn_cardno}"]`);
			if (!card) return;

			const timeEl = card.querySelector('.time');
			if (timeEl && timeEl.textContent !== parseTime(d.logdatetime)) {
				timeEl.textContent = parseTime(d.logdatetime);
			}

			const statusEl = card.querySelector('.status');
			if (statusEl && statusEl.textContent.trim() !== d.direction) {
				statusEl.className = `status-badge ${d.direction.toLowerCase()} status`;
				statusEl.innerHTML = `
					<span class="status-dot"></span>
					${capitalize(d.direction)}
				`;
			}
		}

		function parseTime(datetime) {
			return new Date(datetime).toLocaleTimeString('en-US', {
				hour: 'numeric',
				minute: '2-digit',
				second: '2-digit',
				hour12: true
			})
		}

		function capitalize(word) {
			return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
		}
		
		renderCards();

		// refresh every 3 seconds
		setInterval(renderCards, 3000);
	</script>
</body>
</html>
