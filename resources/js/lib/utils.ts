import { type ClassValue, clsx } from 'clsx';
import { twMerge } from 'tailwind-merge';

export function cn(...inputs: ClassValue[]) {
	return twMerge(clsx(inputs));
}

export function formatNumber(number: number) {
	// Check if the number is less than 10 and prepend '0'
	return number < 10 ? `0${number}` : `${number}`;
}
