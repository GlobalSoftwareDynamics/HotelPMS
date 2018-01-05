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
    var contextMenuClassName = "context-menu";
    var contextMenuItemClassName = "context-menu__item";
    var contextMenuLinkClassName = "context-menu__link";
    var contextMenuActive = "context-menu--active";

    var taskItemClassName = "reserva";
    var taskItemInContext;

    var clickCoords;
    var clickCoordsX;
    var clickCoordsY;

    var menu = document.querySelector("#context-menu");
    var menuItems = menu.querySelectorAll(".context-menu__item");
    var menuState = 0;
    var menuWidth;
    var menuHeight;
    var menuPosition;
    var menuPositionX;
    var menuPositionY;

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

            if ( taskItemInContext ) {
                document.getElementById("ver").setAttribute('href','nuevaReserva.php');

                e.preventDefault();
                toggleMenuOn();
                positionMenu(e);
            } else {
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

            if ( clickeElIsLink ) {
                e.preventDefault();
                menuItemListener( clickeElIsLink );
            } else {
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
        }
    }

    /**
     * Turns the custom context menu off.
     */
    function toggleMenuOff() {
        if ( menuState !== 0 ) {
            menuState = 0;
            menu.classList.remove( contextMenuActive );
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

    /**
     * Dummy action function that logs an action when a menu item link is clicked
     *
     * @param {HTMLElement} link The link that was clicked
     */
    function menuItemListener( link ) {
        if(link.getAttribute("data-action") == "View"){
            window.location.href = 'verReserva.php?idReserva=' + taskItemInContext.getAttribute("data-id");
        }

        if(link.getAttribute("data-action") == "Edit"){
            window.location.href = 'editarReserva.php?idReserva=' + taskItemInContext.getAttribute("data-id");
        }

        if(link.getAttribute("data-action") == "Delete"){
            window.location.href = 'agenda.php?delete=true&idReserva=' + taskItemInContext.getAttribute("data-id");
        }
        if(link.getAttribute("data-action") == "Checkout"){
            window.location.href = 'checkout.php?delete=true&idReserva=' + taskItemInContext.getAttribute("data-id");
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
    $.ajax({
        type: "POST",
        url: "getAjax.php",
        data:{'tipoHabitacion':val},
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