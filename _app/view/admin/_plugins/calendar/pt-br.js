
$.fullCalendar.locale("pt-br", {
	buttonText: {
		today: "Hoje",
		month: "Mês",
		week: "Semana",
		day: "Dia",
		list: "Lista"
	},
	allDayText: "dia inteiro",
	eventLimitText: function(n) {
		return "mais +" + n;
	},
	noEventsMessage: "Não há reservas neste período"
});
