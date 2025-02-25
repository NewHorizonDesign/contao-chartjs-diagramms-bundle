function wrapText(label, maxLineLength) {
  let words = label.split(' ');
  let lines = [];
  let currentLine = '';

  words.forEach(word => {
      if ((currentLine + word).length > maxLineLength) {
          lines.push(currentLine.trim());
          currentLine = word + ' ';
      } else {
          currentLine += word + ' ';
      }
  });

  if (currentLine.length > 0) {
      lines.push(currentLine.trim());
  }

  return lines;
}