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
    title: string;
    description: string;
    products_count: number;
    discount: number;
    start_at: string;
    end_at: string;
    media: Media[];
    branch: Branch;
}
