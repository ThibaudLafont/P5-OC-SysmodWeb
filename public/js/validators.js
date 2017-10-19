function isMaxlen(string, max)
{
    return string.length <= max;
}

function isNotNull(string)
{
    return string.length != 0;
}

function isSelectedStrips(string, selected_strips)
{
    var regex = /<\/?([a-z][a-z0-9]*)\b[^>]*>|<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
    var result = string.match(regex);

    //Cas où il n'y a pas de balise du tout
    if(result === null) return true;

    //Cas où aucune balise n'est acceptée
    if(selected_strips === '' && result !== null) return false;

    //Cas où des balises sont acceptées
    for(var i=0 ; i<result.length; i++){
        if(!selected_strips.includes(result[i])) return false;
    }
    return true; //Si le foreach n'a pas retourné false, on retourne true
}

function isEmail(string) {
    var regex = /.*@.*\..*/g;

    if(string.match(regex)) return true;
    return false;
}