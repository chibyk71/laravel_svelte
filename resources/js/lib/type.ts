import type { EasingFunction } from "svelte/transition";
export type TransitionParams = { delay?: number; duration?: number; easing?: EasingFunction; }

type PaginateData<Data> = {
    current_page: number;
    data: Data[];
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

// home page post data
export type HomeData = PaginateData<Post>

export interface Post {
    id: number;
    caption: string;
    created_at: string;
    updated_at: string;
    medias: Media[];
    isLiked: boolean;
    likes_count: number;
    isPlaying: boolean;
}

export interface Media {
    id: number;
    path: string;
    type: string;
    post_id: number;
    created_at: string;
    updated_at: string;
}

export type  CommentsData = PaginateData<Comment>

export type Comment = {
    id: number;
    content: string;
    user_id: number;
    post_id: number;
    created_at: string; // Assuming ISO 8601 date-time format
    updated_at: string; // Assuming ISO 8601 date-time format
    commenter: User;
    isliked: boolean;
    likes_count: number
    replies:number;
}

export type Reply = {
    id: number,
    content: string;
    created_at: string; // Assuming ISO 8601 date-time format
    updated_at: string; // Assuming ISO 8601 date-time format
    replier: User;
    isliked: boolean;
    likes_count: number;
}
  
export interface User {
    avatar: string | null | undefined;
    id: number;
    name: string;
    email: string;
    email_verified_at: null | string; // Can be null or a string
    created_at: string; // Assuming ISO 8601 date-time format
    updated_at: string; // Assuming ISO 8601 date-time format
    is_admin: boolean;
}