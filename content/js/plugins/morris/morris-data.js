$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2015-1-12',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-13',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-14',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-15',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-16',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-17',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-18',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-19',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-20',
            OK: 12,
            CRITICAL: 9
        }, {
            period: '2015-1-21',
            OK: 12,
            CRITICAL: 9
        }],
        xkey: 'period',
        ykeys: ['OK', 'CRITICAL'],
        labels: ['OK', 'CRITICAL'],
        lineColors: ['#5cb85c', '#d9534f'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Download Sales",
            value: 12
        }, {
            label: "In-Store Sales",
            value: 30
        }, {
            label: "Mail-Order Sales",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: '2006',
            a: 100,
            b: 90
        }, {
            y: '2007',
            a: 75,
            b: 65
        }, {
            y: '2008',
            a: 50,
            b: 40
        }, {
            y: '2009',
            a: 75,
            b: 65
        }, {
            y: '2010',
            a: 50,
            b: 40
        }, {
            y: '2011',
            a: 75,
            b: 65
        }, {
            y: '2012',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
