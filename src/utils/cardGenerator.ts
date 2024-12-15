export const generateCard = (): number[][] => {
  const rows: number[][] = [];
  const usedNumbers = new Set<number>();

  for (let i = 0; i < 3; i++) {
    const row: number[] = [];
    while (row.length < 5) {
      const num = Math.floor(Math.random() * 90) + 1;
      if (!usedNumbers.has(num)) {
        row.push(num);
        usedNumbers.add(num);
      }
    }
    rows.push(row.sort((a, b) => a - b));
  }

  return rows;
};

export const checkWin = (
  card: number[][],
  extractedNumbers: Set<number>,
  rowIndex: number
): boolean => {
  return card[rowIndex].every(num => extractedNumbers.has(num));
};