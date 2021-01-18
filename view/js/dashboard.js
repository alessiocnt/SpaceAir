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
    let data = [
        { key: "Luna",  value: 18  },
        { key: "Marte", value: 45  },
        { key: "Venere", value: 31  }
    ];
    let data2 = [
        { key: "Mercurio 15/04/2020",  value: 20  },
        { key: "Luna 10/10/2019", value: 45  },
        { key: "Venere 5/05/2015", value: 10  },
        { key: "Luna 7/05/2015", value: 5  },
        { key: "Venere 15/07/2020",  value: 20  }
    ];
    const chart = createPlanetGraph("shop",data);
    const piechart = createTicketGraph("popularticket",data2);
    chart.render();
    piechart.render();


    $("#shop").on("click",function() {
        $("#shoptable").slideToggle();
    });
    $("#popularticket").on("click",function() {
        $("#populartickettable").slideToggle();
    });
});