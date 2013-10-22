// generate a random number
function randNum()
{
    return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
}

function equalHeight(boxes)
{
    boxes.height('auto');
    var maxHeight = Math.max.apply(Math, boxes.map(function() {
        return $(this).height();
    }).get());
    boxes.height(maxHeight);
}

function beautify(source)
{
    var output,
            opts = {};

    opts.preserve_newlines = false;

    output = html_beautify(source, opts);
    return output;
}

// generate a random number within a range (PHP's mt_rand JavaScript implementation)
function mt_rand(min, max)
{
    // http://kevin.vanzonneveld.net
    // +   original by: Onno Marsman
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   input by: Kongo
    // *     example 1: mt_rand(1, 1);
    // *     returns 1: 1
    var argc = arguments.length;
    if (argc === 0) {
        min = 0;
        max = 2147483647;
    }
    else if (argc === 1) {
        throw new Error('Warning: mt_rand() expects exactly 2 parameters, 1 given');
    }
    else {
        min = parseInt(min, 10);
        max = parseInt(max, 10);
    }
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

// scroll to element animation
function scrollTo(id)
{
    if ($(id).length)
        $('html,body').animate({scrollTop: $(id).offset().top}, 'slow');
}

