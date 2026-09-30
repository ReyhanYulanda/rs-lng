import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

const pendaftaranPatientChart = document.getElementById('pendaftaran-patient-chart');
const pendaftaranStatusChart = document.getElementById('pendaftaran-status-chart');
const doctorPatientChart = document.getElementById('doctor-patient-chart');

if (pendaftaranPatientChart || pendaftaranStatusChart || doctorPatientChart) {
	import('chart.js/auto').then(({ default: Chart }) => {
		if (pendaftaranPatientChart) {
			new Chart(pendaftaranPatientChart, {
				type: 'bar',
				data: {
					labels: JSON.parse(pendaftaranPatientChart.dataset.labels),
					datasets: [{
						label: 'Pasien unik',
						data: JSON.parse(pendaftaranPatientChart.dataset.values),
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
		}

		if (pendaftaranStatusChart) {
			new Chart(pendaftaranStatusChart, {
				type: 'bar',
				data: {
					labels: JSON.parse(pendaftaranStatusChart.dataset.labels),
					datasets: [{
						label: 'Jumlah pendaftaran',
						data: JSON.parse(pendaftaranStatusChart.dataset.values),
						backgroundColor: '#2563eb',
						borderRadius: 4,
						maxBarThickness: 42,
					}],
				},
				options: {
					indexAxis: 'y',
					responsive: true,
					maintainAspectRatio: false,
					plugins: {
						legend: { display: false },
						tooltip: {
							callbacks: {
								label: (context) => `${context.parsed.x} pendaftaran`,
							},
						},
					},
					scales: {
						x: {
							beginAtZero: true,
							ticks: { precision: 0, stepSize: 1 },
						},
						y: {
							grid: { display: false },
						},
					},
				},
			});
		}

		if (doctorPatientChart) {
			new Chart(doctorPatientChart, {
				type: 'pie',
				data: {
					labels: JSON.parse(doctorPatientChart.dataset.labels),
					datasets: [{
						label: 'Pasien unik',
						data: JSON.parse(doctorPatientChart.dataset.values),
						backgroundColor: ['#0f766e', '#2563eb', '#eab308', '#db2777', '#7c3aed', '#ea580c', '#0891b2', '#65a30d'],
						borderColor: '#ffffff',
						borderWidth: 2,
					}],
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					plugins: {
						legend: {
							position: 'bottom',
						},
						tooltip: {
							callbacks: {
								label: (context) => `${context.label}: ${context.parsed} pasien`,
							},
						},
					},
				},
			});
		}
	});
}
