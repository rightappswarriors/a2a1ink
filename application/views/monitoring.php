<?php $this->load->view('components/monitoring_header'); ?>

	<div class="wrapper">
		<div class="container" id="timekeeping-container"></div>
	</div>

	<script>
		const container = document.getElementById("timekeeping-container");

		let lastData = new Map();

		async function getData() {
			try {
				const key = getKey();
				const response = await fetch(`monitoring/getdata?key=${key}`);
				const data = await response.json();
				console.log(data)
				return data.records || [];
			} catch (error) {
				console.error('Failed to fetch data:', error);
				return [];
			}
		}

		const getKey = () => {
			const getKeyUrl = new URLSearchParams(window.location.search).get('key');

			if(!getKeyUrl) return ''

			return getKeyUrl
		};

		async function renderCards() {
			const data = await getData();

			if(!getKey()) {
				container.innerHTML = `
					<div class="info"
						<h1>Empty Key, Cannot fetch data.</h1>
					</div>`

			}

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
				<img src="${d.photo}" class="photo" alt="${d.name}" />

				<div class="info">
					<div class="info-header">
						<span class="info-name">${d.name}</span>
						<span class="info-id">ID: ${d.id}</span>
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
