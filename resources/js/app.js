import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const pendaftaranPatientChart = document.getElementById('pendaftaran-patient-chart');

if (pendaftaranPatientChart) {
	const labels = JSON.parse(pendaftaranPatientChart.dataset.labels);
	const values = JSON.parse(pendaftaranPatientChart.dataset.values);

	import('chart.js/auto').then(({ default: Chart }) => {
		new Chart(pendaftaranPatientChart, {
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
