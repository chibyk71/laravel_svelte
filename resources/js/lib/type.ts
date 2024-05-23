import type { EasingFunction } from "svelte/transition";
export type TransitionParams = { delay?: number; duration?: number; easing?: EasingFunction; }

// home page post data
export interface HomeData {
    current_page: number;
    data: Post[];
    first_page_url: string;
    from: number;
    last_page: number;
    last_page_url: string;
    next_page_url: string | null;
    path: string;
    per_page: number;
    prev_page_url: string | null;
    to: number;
    total: number;
}

export interface Post {
    id: number;
    caption: string;
    created_at: string;
    updated_at: string;
    medias: Media[];
    isLiked: boolean;
    likes_count: number;
}

export interface Media {
    id: number;
    path: string;
    type: string;
    post_id: number;
    created_at: string;
    updated_at: string;
}