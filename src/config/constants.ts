export const API_URL = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

export const WIN_TYPES = {
  ambo: 'Ambo',
  terno: 'Terno',
  quaterna: 'Quaterna',
  cinquina: 'Cinquina',
  tombola: 'Tombola'
} as const;

export const WIN_CONDITIONS = {
  ambo: 2,
  terno: 3,
  quaterna: 4,
  cinquina: 5,
  tombola: 15
} as const;