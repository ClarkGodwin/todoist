export type Task = {
    id: number;
    // user_id: number;
    title: string;
    description: string;
    day : string;
    status: string;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
};

// export type Task = {
//     user: User;
// };
