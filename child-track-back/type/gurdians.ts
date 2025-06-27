interface GuardiansResponse {
    current_page: number;
    data: Guardian[];
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

interface Guardian {
    id: number;
    username: string;
    name: string;
    last: string;
    date_of_birth: string; // Format: YYYY-MM-DD
    created_at: string;
    updated_at: string;
    baladya_id: number;
    phones: Phone[];
    baladya: {
        id: number;
        name: string;
        created_at: string;
        updated_at: string;
        wilaya_id: number;
        wilaya: {
            id: number;
            name: string;
            created_at: string;
            updated_at: string;
        };
    };
    key: Key | null;
}

interface Phone {
    id: number;
    number: string;
    phoneable_type: string;
    phoneable_id: number;
    created_at: string;
    updated_at: string;
}

interface Key {
    id: number;
    value: string;
    status: 'used' | 'unused';
    keyable_type: string;
    keyable_id: number;
    created_at: string;
    updated_at: string;
    user: User | null;
}

interface User {
    id: number;
    email: string;
    phone: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    key_id: number;
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface CreateGuardianRequest {
    name: string;
    last: string;
    date_of_birth: string; // Format: YYYY-MM-DD
    baladya_id: number;
}
interface CreateGuardianSuccessResponse {
    name: string;
    last: string;
    date_of_birth: string;
    baladya_id: number;
    username: string;
    updated_at: string;
    created_at: string;
    id: number;
}

interface CreateGuardianErrorResponse {
    message: string;
    errors: {
        name?: string[];
        last?: string[];
        date_of_birth?: string[];
        baladya_id?: string[];
    };
}

export {
    GuardiansResponse,
    Guardian,
    Phone,
    Key,
    User,
    PaginationLink,
    CreateGuardianRequest,
    CreateGuardianSuccessResponse
}