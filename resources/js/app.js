import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const poliPatientChart = document.getElementById('poli-patient-chart');

if (poliPatientChart) {
	const labels = JSON.parse(poliPatientChart.dataset.labels);
	const values = JSON.parse(poliPatientChart.dataset.values);

	import('chart.js/auto').then(({ default: Chart }) => {
		new Chart(poliPatientChart, {
			type: 'bar',
			data: {
				labels,
				datasets: [{
					label: 'Pasien unik',
					data: values,
					backgroundColor: '#0f766e',
					borderRadius: 4,
					maxBarThickness: 48,
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					legend: { display: false },
					tooltip: {
						callbacks: {
							label: (context) => `${context.parsed.y} pasien`,
						},
					},
				},
				scales: {
					x: {
						grid: { display: false },
					},
					y: {
						beginAtZero: true,
						ticks: { precision: 0, stepSize: 1 },
					},
				},
			},
		});
	});
}
