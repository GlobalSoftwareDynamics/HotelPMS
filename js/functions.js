(function() {

    "use strict";

    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    //
    // H E L P E R    F U N C T I O N S
    //
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////

    /**
     * Function to check if we clicked inside an element with a particular class
     * name.
     *
     * @param {Object} e The event
     * @param {String} className The class name to check against
     * @return {Boolean}
     */
    function clickInsideElement( e, className ) {
        var el = e.srcElement || e.target;

        if ( el.classList.contains(className) ) {
            return el;
        } else {
            while ( el = el.parentNode ) {
                if ( el.classList && el.classList.contains(className) ) {
                    return el;
                }
            }
        }

        return false;
    }

    /**
     * Get's exact position of event.
     *
     * @param {Object} e The event passed in
     * @return {Object} Returns the x and y position
     */
    function getPosition(e) {
        var posx = 0;
        var posy = 0;

        if (!e) var e = window.event;

        if (e.pageX || e.pageY) {
            posx = e.pageX;
            posy = e.pageY;
        } else if (e.clientX || e.clientY) {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }

        return {
            x: posx,
            y: posy
        }
    }

    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////
    //
    // C O R E    F U N C T I O N S
    //
    //////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////

    /**
     * Variables.
     */
    var contextMenuLinkClassName = "context-menu__link";
    var contextMenuActive = "context-menu--active";
    var contextMenuLinkClassName1 = "context-menu__link1";
    var contextMenuLinkClassName2 = "context-menu__link2";

    var taskItemClassName = "reserva";
    var taskItemClassName1 = "estadia";
    var taskItemClassName2 = "finalizada";
    var taskItemInContext;
    var taskItemInContext1;
    var taskItemInContext2;

    var clickCoords;
    var clickCoordsX;
    var clickCoordsY;

    var menu = document.querySelector("#context-menu");
    var menu1 = document.querySelector("#context-menu1");
    var menu2 = document.querySelector("#context-menu2");
    var menuState = 0;
    var menuWidth;
    var menuHeight;

    var windowWidth;
    var windowHeight;

    /**
     * Initialise our application's code.
     */
    function init() {
        contextListener();
        clickListener();
        keyupListener();
        resizeListener();
    }

    /**
     * Listens for contextmenu events.
     */
    function contextListener() {
        document.addEventListener( "contextmenu", function(e) {
            taskItemInContext = clickInsideElement( e, taskItemClassName );
            taskItemInContext1 = clickInsideElement(e,taskItemClassName1);
            taskItemInContext2 = clickInsideElement(e,taskItemClassName2);

            if ( taskItemInContext ) {
                console.log("1");

                document.getElementById("checkin").setAttribute('data-id',taskItemInContext.getAttribute("data-id"));
                document.getElementById("ver").setAttribute('data-id',taskItemInContext.getAttribute("data-id")+"_"+taskItemInContext.getAttribute("data-habitacion"));
                document.getElementById("editar").setAttribute('data-id',taskItemInContext.getAttribute("data-id"));
                document.getElementById("eliminar").setAttribute('data-id',taskItemInContext.getAttribute("data-id"));
                document.getElementById("agregar").setAttribute('data-id',taskItemInContext.getAttribute("data-id")+"_"+taskItemInContext.getAttribute("data-habitacion"));

                e.preventDefault();
                toggleMenuOn();
                positionMenu(e);
            }

            if( taskItemInContext1 ){
                console.log("2");

                document.getElementById("consumo").setAttribute('data-id',taskItemInContext1.getAttribute("data-id")+"_"+taskItemInContext1.getAttribute("data-habitacion"));
                document.getElementById("checkout").setAttribute('data-id',taskItemInContext1.getAttribute("data-id")+"_"+taskItemInContext1.getAttribute("data-habitacion"));
                document.getElementById("ver1").setAttribute('data-id',taskItemInContext1.getAttribute("data-id")+"_"+taskItemInContext1.getAttribute("data-habitacion"));
                document.getElementById("editar1").setAttribute('data-id',taskItemInContext1.getAttribute("data-id"));
                document.getElementById("agregar1").setAttribute('data-id',taskItemInContext1.getAttribute("data-id")+"_"+taskItemInContext1.getAttribute("data-habitacion"));

                e.preventDefault();
                toggleMenuOn1();
                positionMenu1(e);
            }

            if( taskItemInContext2 ){
                console.log("3");

                document.getElementById("ver2").setAttribute('data-id',taskItemInContext2.getAttribute("data-id")+"_"+taskItemInContext2.getAttribute("data-habitacion"));

                e.preventDefault();
                toggleMenuOn2();
                positionMenu2(e);
            }

            if(!taskItemInContext && !taskItemInContext1 && !taskItemInContext2) {
                taskItemInContext = null;
                toggleMenuOff();
            }
        });
    }

    /**
     * Listens for click events.
     */
    function clickListener() {
        document.addEventListener( "click", function(e) {
            var clickeElIsLink = clickInsideElement( e, contextMenuLinkClassName );
            var clickeElIsLink1 = clickInsideElement( e, contextMenuLinkClassName1 );
            var clickeElIsLink2 = clickInsideElement( e, contextMenuLinkClassName2 );


            if ( clickeElIsLink ) {
                e.preventDefault();
                menuItemListener( clickeElIsLink );
            }

            if ( clickeElIsLink1 ) {
                e.preventDefault();
                menuItemListener( clickeElIsLink1 );
            }

            if ( clickeElIsLink2 ) {
                e.preventDefault();
                menuItemListener( clickeElIsLink2 );
            }

            if(!clickeElIsLink && !clickeElIsLink1 && !clickeElIsLink2) {
                var button = e.which || e.button;
                if ( button === 1 ) {
                    toggleMenuOff();
                }
            }
        });
    }

    /**
     * Listens for keyup events.
     */
    function keyupListener() {
        window.onkeyup = function(e) {
            if ( e.keyCode === 27 ) {
                toggleMenuOff();
            }
        }
    }

    /**
     * Window resize event listener
     */
    function resizeListener() {
        window.onresize = function(e) {
            toggleMenuOff();
        };
    }

    /**
     * Turns the custom context menu on.
     */
    function toggleMenuOn() {
        if ( menuState !== 1 ) {
            menuState = 1;
            menu.classList.add( contextMenuActive );
            menu1.classList.remove( contextMenuActive );
            menu2.classList.remove( contextMenuActive );
        }
    }

    function toggleMenuOn1() {
        if ( menuState !== 1 ) {
            menuState = 1;
            menu.classList.remove( contextMenuActive );
            menu1.classList.add( contextMenuActive );
            menu2.classList.remove( contextMenuActive );
        }
    }

    function toggleMenuOn2() {
        if ( menuState !== 1 ) {
            menuState = 1;
            menu.classList.remove( contextMenuActive );
            menu1.classList.remove( contextMenuActive );
            menu2.classList.add( contextMenuActive );
        }
    }

    /**
     * Turns the custom context menu off.
     */
    function toggleMenuOff() {
        if ( menuState !== 0 ) {
            menuState = 0;
            menu.classList.remove( contextMenuActive );
            menu1.classList.remove( contextMenuActive );
            menu2.classList.remove( contextMenuActive );
        }
    }

    /**
     * Positions the menu properly.
     *
     * @param {Object} e The event
     */
    function positionMenu(e) {
        clickCoords = getPosition(e);
        clickCoordsX = clickCoords.x;
        clickCoordsY = clickCoords.y;

        menuWidth = menu.offsetWidth + 4;
        menuHeight = menu.offsetHeight + 4;

        windowWidth = window.innerWidth;
        windowHeight = window.innerHeight;

        if ( (windowWidth - clickCoordsX) < menuWidth ) {
            menu.style.left = windowWidth - menuWidth + "px";
        } else {
            menu.style.left = clickCoordsX + "px";
        }

        if ( (windowHeight - clickCoordsY) < menuHeight ) {
            menu.style.top = windowHeight - menuHeight + "px";
        } else {
            menu.style.top = clickCoordsY + "px";
        }
    }

    function positionMenu1(e) {
        clickCoords = getPosition(e);
        clickCoordsX = clickCoords.x;
        clickCoordsY = clickCoords.y;

        menuWidth = menu1.offsetWidth + 4;
        menuHeight = menu1.offsetHeight + 4;

        windowWidth = window.innerWidth;
        windowHeight = window.innerHeight;

        if ( (windowWidth - clickCoordsX) < menuWidth ) {
            menu1.style.left = windowWidth - menuWidth + "px";
        } else {
            menu1.style.left = clickCoordsX + "px";
        }

        if ( (windowHeight - clickCoordsY) < menuHeight ) {
            menu1.style.top = windowHeight - menuHeight + "px";
        } else {
            menu1.style.top = clickCoordsY + "px";
        }
    }

    function positionMenu2(e) {
        clickCoords = getPosition(e);
        clickCoordsX = clickCoords.x;
        clickCoordsY = clickCoords.y;

        menuWidth = menu2.offsetWidth + 4;
        menuHeight = menu2.offsetHeight + 4;

        windowWidth = window.innerWidth;
        windowHeight = window.innerHeight;

        if ( (windowWidth - clickCoordsX) < menuWidth ) {
            menu2.style.left = windowWidth - menuWidth + "px";
        } else {
            menu2.style.left = clickCoordsX + "px";
        }

        if ( (windowHeight - clickCoordsY) < menuHeight ) {
            menu2.style.top = windowHeight - menuHeight + "px";
        } else {
            menu2.style.top = clickCoordsY + "px";
        }
    }

    /**
     * Dummy action function that logs an action when a menu item link is clicked
     *
     * @param {HTMLElement} link The link that was clicked
     */
    function menuItemListener( link ) {
        if(link.getAttribute("data-action") == "View"){
            window.location.href = 'verReserva.php?idReserva=' + link.getAttribute("data-id");
        }

        if(link.getAttribute("data-action") == "Edit"){
            window.location.href = 'nuevaReserva.php?idReserva=' + link.getAttribute("data-id");
        }

        if(link.getAttribute("data-action") == "Delete"){
            window.location.href = 'agenda.php?delete=true&idReserva=' + link.getAttribute("data-id");
        }

        if(link.getAttribute("data-action") == "Checkout"){
            window.location.href = 'registrarCheckout.php?delete=true&idReserva=' + link.getAttribute("data-id");
        }

        if(link.getAttribute("data-action") == "Checkin"){
            window.location.href = 'nuevaReserva.php?delete=true&idReserva=' + link.getAttribute("data-id");
        }

        if(link.getAttribute("data-action") == "Consumo"){
            window.location.href = 'nuevoConsumo.php?delete=true&idReserva=' + link.getAttribute("data-id");
        }

        if(link.getAttribute("data-action") == "AgregarDia"){
            var modal = '#'+ link.getAttribute("data-id");
            $(modal).modal('show');
        }

        console.log( "Task ID - " + taskItemInContext.getAttribute("data-id") + ", Task action - " + link.getAttribute("data-action"));
        toggleMenuOff();
    }
    /**
     * Run the app.
     */
    init();

})();

function getEstado(val) {
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'idPais':val},
        success: function(data){
            $("#estado").html(data);
        }
    });
}

function getCiudad(val) {
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'idEstado':val},
        success: function(data){
            $("#ciudad").html(data);
        }
    });
}

function getID(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'nombreHuesped':val},
        success: function(data){
            $("#divDni").html(data);
        }
    });
}

function getID2(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'nombreHuespedReserva':val},
        success: function(data){
            $("#divDni").html(data);
        }
    });
}

function getEmpresa(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'razonSocial':val},
        success: function(data){
            $("#empresa").html(data);
        }
    });
}

function getEmpresa1(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'razonSocialB':val},
        success: function(data){
            $("#empresa").html(data);
        }
    });
}

function getTelf(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'nombreHuesped2':val},
        success: function(data){
            $("#divTelf").html(data);
        }
    });
}

function getEmail(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'nombreHuesped3':val},
        success: function(data){
            $("#divEmail").html(data);
        }
    });
}

function getNombre(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'nombreHuesped4':val},
        success: function(data){
            $("#divNombre").html(data);
        }
    });
}

function getNombre2(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'nombreHuespedReserva2':val},
        success: function(data){
            $("#divNombre").html(data);
        }
    });
}

function getHabitacion(val){

    var fechaInicio = document.getElementById("inicioCheckIn").value;
    var fechaFin = document.getElementById("finCheckOut").value;

    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'tipoHabitacion':val, 'fechaInicioCheckIn': fechaInicio, 'fechaFinCheckOut': fechaFin},
        success: function(data){
            $("#nroHabitacion").html(data);
        }
    });
}

function getTarifa(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'tipoHabitacion2':val},
        success: function(data){
            $("#tarifa").html(data);
        }
    });
}

function getDatosOcupante(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'datosOcupante':val},
        success: function(data){
            $("#contenidoModalOcupante").html(data);
        }
    });
}

function getPaquete(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'tipoReserva':val},
        success: function(data){
            $("#paquete").html(data);
        }
    });
}

function getCalendar(val){
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'fechaGuia':val},
        success: function(data){
            $("#calendario").html(data);
        }
    });
}
