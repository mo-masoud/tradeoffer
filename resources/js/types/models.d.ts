export interface Category {
	id: number;
	name: string;
	image: string;
	children: Category[];
}

export interface Media {
	url: string;
}

export interface Store {
	id: number;
	name: string;
	description: string;
	image: string;
}

export interface Branch {
	id: number;
	name: string;
	address: string;
	latitude: number;
	longitude: number;
	covered_zone: number;
	phone: string;
	store: Store;
}

export interface Offer {
	id: number;
	title: string;
	description: string;
	discount: number;
	max_discount: number;
	start_at: string;
	end_at: string;
	media: Media[];
	store: Store;
}

export interface Product {
	id: number;
	name: string;
	description: string;
	price: number;
	discount: number;
	meta: { [key: string]: string };
	has_offer: boolean;
	media: Media[];
	store: Store;
	categories: Category[];
	branches: Branch[];
}
