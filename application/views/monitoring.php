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
			font-family: Arial, sans-serif;
		}

		body {
			background: #f2f2f2;
		}

		/* 3-COLUMN GRID */
		.container {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			height: 100vh;
			padding: 20px;
			gap: 20px;
		}

		/* CARD */
		.card {
			background: #fff;
			border-radius: 12px;
			padding: 15px;
			box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
		}

		/* IMAGE */
		.photo {
			width: 100%;
			height: 70%;
			object-fit: cover;
			border: 3px solid #000;
			border-radius: 8px;
			margin-bottom: 10px;
		}

		/* INFO */
		.info p {
			font-size: 18px;
			margin: 5px 0;
		}

		.status {
			color: green;
			font-weight: bold;
		}
	</style>

</head>

<body>

<div class="container" id="timekeeping-container"></div>


<script>
	//test
	const container = document.getElementById("timekeeping-container");

	// simulate backend data (replace with API later)
	function getData() {
		const now = new Date();

		return [
			{
				photo: "https://via.placeholder.com/400x300?text=Student+1",
				name: "Juan dela Cruz",
				id: "2026-00001",
				time: now.toLocaleTimeString(),
				date: now.toISOString().split('T')[0],
				status: "IN"
			},
			{
				photo: "https://via.placeholder.com/400x300?text=Student+2",
				name: "Maria Santos",
				id: "2026-00002",
				time: now.toLocaleTimeString(),
				date: now.toISOString().split('T')[0],
				status: "IN"
			},
			{
				photo: "https://via.placeholder.com/400x300?text=Student+3",
				name: "Pedro Reyes",
				id: "2026-00003",
				time: now.toLocaleTimeString(),
				date: now.toISOString().split('T')[0],
				status: "IN"
			}
		];
	}

	function renderCards() {
		const data = getData();

		container.innerHTML = data.map(d => `
			<div class="card">
				<img src="${d.photo}" class="photo" />
				<div class="info">
					<p><strong>Name:</strong> ${d.name}</p>
					<p><strong>ID:</strong> ${d.id}</p>
					<p><strong>Time:</strong> ${d.time}</p>
					<p><strong>Date:</strong> ${d.date}</p>
					<p><strong>Status:</strong> <span class="status">${d.status}</span></p>
				</div>
			</div>
		`).join('');
	}

	renderCards();

	// refresh every 3 seconds
	setInterval(renderCards, 3000);
</script>

</body>
</html>
