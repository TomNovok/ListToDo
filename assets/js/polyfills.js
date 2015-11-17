if (!Element.prototype.matches)
{
    // определяем свойство
    Element.prototype.matches = Element.prototype.matchesSelector ||
      Element.prototype.webkitMatchesSelector ||
      Element.prototype.mozMatchesSelector ||
      Element.prototype.msMatchesSelector

}

if (!Element.prototype.closest)
{
    // реализуем
    Element.prototype.closest = function(css)
    {
      var node = this;
      while (node)
      {
        if (node.matches(css)) return node;
        else node = node.parentElement;
      }
      return null;
    };
}