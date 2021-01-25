function createPlanetGraph(id,inputData) {
    
    const dataEntry = [];
    inputData.forEach((entry) => {
        dataEntry.push({label:entry["key"], y:entry["value"]});
    });

    let tableId = "#"+id+"table";
    let tableHtml = "";
    //Create table for accessibility
    tableHtml += `
    <table class="mt-3 col-10 offset-1 table table-light table-striped">
        <thead class="col-btn-impo">
            <tr>
                <th id="planet">Pianeta</th>
                <th id="ticketsold">Biglietti venduti</th>
            </tr>
        </thead><tbody>`;
    
    inputData.forEach((entry) => {
        tableHtml += `
        <tr>
            <td headers="planet">${entry["key"]}</td>
            <td headers="ticketsold">${entry["value"]}</td>
        </tr>
        `;
    });

    tableHtml += "</tbody></table>";
    $(tableId).html(tableHtml);

    return new CanvasJS.Chart(id+"chart", {
        backgroundColor: "#071E39",
        theme: "light2", // "light2", "dark1", "dark2"
        interactivityEnabled: false,
        animationEnabled: false, // change to true		
        title:{
            text: ""
        },
        axisX:{
            title: "",
            lineColor: "white",
            labelFontColor: "#E4E4E4",
        },
        axisY:{
            title: "",
            lineColor: "white",
            labelFontColor: "#E4E4E4",
        },
        data: [
        {
            // Change type to "bar", "area", "spline", "pie",etc.
            type: "column",
            color: "white",
            dataPoints: dataEntry
        }
        ]
    });
}

function createTicketGraph(id, inputData) {

    const dataEntry = [];
    inputData.forEach((entry) => {
        dataEntry.push({y:entry["value"], label:entry["key"]});
    });

    let tableId = "#"+id+"table";
    let tableHtml = ""
    //Create table for accessibility
    tableHtml += `
    <table class="mt-3 col-10 offset-1 table table-light table-striped">
        <thead class="col-btn-impo">
            <tr>
                <th id="ticket">Viaggio</th>
                <th id="percentuale">Percentuale</th>
            </tr>
        </thead><tbody>`;
    
    inputData.forEach((entry) => {
        tableHtml += `
        <tr>
            <td headers="ticket">${entry["key"]}</td>
            <td headers="percentuale">${entry["value"]}</td>
        </tr>
        `;
    });

    $(tableId).html(tableHtml);

    return new CanvasJS.Chart(id+"chart", {
        theme: "light2", // "light1", "light2", "dark1", "dark2"
        animationEnabled: true,
        interactivityEnabled: false,
        backgroundColor: "#E4E4E4",
        title: {
            text: ""
        },
        data: [{
            type: "pie",
            startAngle: 25,
            indexLabelFontSize: 16,
            dataPoints: dataEntry
        }]
    });
}


$(document).ready(function() {

    $.getJSON("./controller/api/StaticsApi.php", function(data){ 
        let dataSales = [];
        let dataPopularPacket = [];
        data.sales.forEach((e) => {
            dataSales.push({key: e.planet, value: parseInt(e.quantity)});
        });
        data.popularPacket.forEach((e) => {
            dataPopularPacket.push({key: e.planet + " " + e.date, value: parseInt(e.quantity)});
        });

        const chart = createPlanetGraph("shop",dataSales);
        const piechart = createTicketGraph("popularticket",dataPopularPacket);
        chart.render();
        piechart.render();
    });

    $("#shop").on("click",function() {
        $("#shoptable").toggleClass("sr-only");
    });
    $("#popularticket").on("click",function() {
        $("#populartickettable").toggleClass("sr-only");
    });
});