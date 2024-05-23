export const handleSubmit = (form: { post: (arg0: string) => void },url:string)=> {
    form.post(url)
}