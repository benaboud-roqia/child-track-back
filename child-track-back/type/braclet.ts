interface BraceletsResponse {
    current_page: number;
    data: Bracelet[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    links: PaginationLink[];
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

interface Bracelet {
    id: number;
    mac: string;
    status: "on" | "off";
    created_at: string;
    updated_at: string;
    children_id: number;
    children: null; // Assuming this could be a Children interface if not null
    location: {
        id: number;
        lat: number;
        lng: number;
        locationable_type: string;
        locationable_id: number;
        created_at: string;
        updated_at: string;
    };
    circle: {
        id: number;
        radius: number;
        created_at: string;
        updated_at: string;
        braclet_id: number;
    }[];
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}


interface CreateBraceletRequest {
    mac: string;
    status?: "on" | "off" ; // Optional with default likely being "off"
}

interface CreateBraceletErrorResponse {
    message: string;
    errors?: {
        mac?: string[];
        status?: string[];
    };
}